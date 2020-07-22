<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmailable;

use App\User;
use App\Sector;
use App\Jenazah;
use App\Jenazahdocs;
use App\Trx;
use App\Package;
use App\Payment;
use Auth;
use DB;

class AhliwarisController extends Controller
{

    public function getUserId() {
        $userId = auth()->guard('user')->user()->id;
        return $userId;
    }

    public function getSeat($sector_code) {
        $sector = Sector::where('sector_code', $sector_code)->where('trx_id', null)->select('seat')->get();
        return response()->json($sector, 200);
    }

    public function index() {
        return view('ahliwaris.index');
    }

    // create & store jenazah
    public function create() {
        return view('ahliwaris.create');
    }

    public function store(Request $request) {
        
        $input = $request->except(['doc', 'sector', 'seat', 'package']);
        Jenazah::create($input);

        $doc    = $request->doc;
        $seat   = $request->seat;
        $pkg    = $request->package;

        $lastJenazah = Jenazah::latest()->first();
        // about file rules
        $fileName = time().'.'.$doc->extension();  
        $doc->move(public_path('death_documents'), $fileName);

        Jenazahdocs::create([
            'jenazah_id' => $lastJenazah->id,
            'pathname' => $fileName,
            'status' => 0
        ]);
        
        // Set status payment 3 because rebuild record..
        Payment::create([ 'status' => 3 ]);

        $lastPayment = Payment::latest()->first();
        Trx::create([
            'user_id' => auth()->guard('user')->user()->id,
            'jenazah_id' => $lastJenazah->id,
            'package_id' => $pkg,
            'payment_id' => $lastPayment->id
        ]);

        $lastTrx = Trx::latest()->first();
        Sector::where('seat', $seat)->update([
            'trx_id' => $lastTrx->id
        ]);
        // kayaknya buat langsung buat tabel payment
        
        return redirect()->route('ahliwaris.detail', $lastJenazah->id)->withMsg('Pesanan berhasil dibuat');
    }

    public function detail($jenazah_id) {
        $jenazah = Jenazah::find($jenazah_id);
        $doc     = Jenazahdocs::where('jenazah_id', $jenazah_id)->first();

        $data    = Trx::where('jenazah_id', $jenazah_id)->first();
        $trxid   = $data->id; 
        $paymentid = $data->payment_id;

        $pkgname = Package::find($data->package_id);
        $pkgname = $pkgname->name;

        $setSeat = Sector::where('trx_id', $trxid)->first();
        $seat    = $setSeat->seat;

        $payment = Payment::find($paymentid);

        return view('ahliwaris.detail', compact(
            'jenazah', 
            'doc', 
            'pkgname', 
            'trxid',
            'paymentid',
            'seat'
        ));
    }

    public function payment() {
        return view('ahliwaris.payment');
    }

    public function paymentStore(Request $request, $trxid) {
        $input = $request->except('doc');
        // about file rules
        $doc = $request->doc;
        $fileName = time().'.'.$doc->extension();  
        $doc->move(public_path('invoice_documents'), $fileName);

        $trx = Trx::find($trxid);
        $paymentId = $trx->payment_id;
        Payment::where('id', $paymentId)
            ->update([
            'sender' => $request->sender,
            'from_bank' => $request->from_bank,
            'to_bank' => $request->to_bank,
            'acc_number' => $request->acc_number,
            'amount' => $request->amount,
            'pathname' => $fileName,
            'status' => 0
        ]);
            // if($processPayment) {
            //     $getLastPayment = Payment::latest()->first();
            //     Trx::where('id', $trxid)->update([
            //         'payment_id' => $getLastPayment->id
            //     ]);
            // }
        return redirect()->back();
    }

    // Profile
    public function profile() {
        $userId = AhliwarisController::getUserId();
        $userdata = User::find($userId);
        return view('ahliwaris.editprofile', compact('userdata'));
    }

    public function updateProfile(Request $request) {
        $userId = AhliwarisController::getUserId();
        User::find($userId)->update($request->all());
        return back()->withSuccess('Data berhasil diubah');
    }

    public function documentStore(Request $request, $jenazah_id) {
        $doc = $request->doc;
        $fileName = time().'.'.$doc->extension();  
        $doc->move(public_path('death_documents'), $fileName);

        Jenazahdocs::where('jenazah_id', $jenazah_id)->update([
            'pathname' => $fileName,
            'status' => 0
        ]);
        return redirect()->back();
    }

    // check schedule
    public function checkSchedule($jenazah_id) {
        $getTrx = DB::table('trx')
                ->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                ->join('sector', 'sector.trx_id', '=', 'trx.id')
                ->join('users', 'users.id', '=', 'trx.user_id')
                ->join('package', 'package.id', '=', 'trx.package_id')
                ->join('payment', 'payment.id', '=', 'trx.payment_id')
                ->where('jenazah.id', '=', $jenazah_id)
                ->select(
                    'users.name as ahliwaris',
                    'users.email as email',
                    'jenazah.name as jenazah',
                    'jenazah.identity as identitas',
                    'jenazah.religion as agama',
                    'jenazah.gender as jk',
                    'jenazah.birth as lahir',
                    'jenazah.death as mati',
                    'sector.seat as blok',
                    'trx.created_at as created_at',
                    'trx.id as transaction_id',
                    'package.price as pkg_price',
                    'payment.created_at as payment_created_at'
                )->first();
        Mail::to($getTrx->email)->send(new Sendmailable(null, null, null, $getTrx, null));
        return redirect()->back()->withMsg('Schedule was sent to '.$getTrx->email);
        
    }
}
