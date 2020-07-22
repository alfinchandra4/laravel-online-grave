<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sendmailable;

use carbon\Carbon;
use App\Gallery;
use Image;
use File;
use App\User;
use App\Package;
use App\Jenazah;
use App\Jenazahdocs;
use App\PackageDetail;
use App\Payment;
use App\Trx;
use DB;

class AdminController extends Controller
{
    public $path;

    public function index() {
        return view('admin.index');
    }

    public function __construct() {
        $this->path = storage_path('app/public/gallery');   
    }

    // Gallery
    public function gallery() {
        return view('admin.gallery');
    }

    public function storeImage(Request $request) {
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        $saveFile = public_path() . '/gallery/' . $fileName;
        Image::make($file)->save($saveFile);
        // dd($file, $fileName);
        Gallery::create(
            ['pathname' => $fileName]
        );
        return redirect()->back(); //->withSuccess('Gambar berhasil ditambah');
    }

    public function removeImage($photoid) {
        $locationImage = public_path() . '/gallery';
        $getImageName = Gallery::find($photoid);
        $file = $getImageName->pathname;
        File::delete($locationImage . '/' . $file);
        Gallery::find($photoid)->delete();
        return redirect()->back(); //->withFail('Gambar berhasil dihapus');
    }

    // Package
    public function packageCreate() {
        return view('admin.createpackage');
    }

    public function package() {
        return view('admin.package');
    }

    public function packageStore(Request $request) {
        Package::updateOrCreate(
            ['package_code' => strtoupper($request->package_code)],
            [
                'package_code' => strtoupper($request->package_code),
                'name' => $request->name,
                'price' => $request->price,
                'active' => 1
            ]
        );
        return redirect()->route('admin.package');
    }

    public function packageEnable($package_id) {
        Package::where('id', $package_id)->update(['active' => 1]);
        return redirect()->back();
    }

    public function packageDisable($package_id) {
        Package::where('id', $package_id)->update(['active' => 0]);
        return redirect()->back();
    }

    public function packageRemove($package_id) {
        Package::find($package_id)->delete();
        return redirect()->back();
    }

    // Package detail
    public function packageBenefit($package_id) {
        $details = PackageDetail::where('package_id', $package_id)->get();
        $pkg = Package::find($package_id);
        return view('admin.benefit', compact('details', 'pkg'));
    }

    public function packagedetailStore(Request $request, $package_id) {
        PackageDetail::create([
            'package_id' => $package_id,
            'value'      => $request->value
        ]);
        return redirect()->back();
    }

    public function packagedetailRemove($benefit_id) {
        PackageDetail::find($benefit_id)->delete();
        return redirect()->back();
    }

    // Documents
    public function documents() {
        return view('admin.documents');
    }

    public function documentsReject($jenazah_doc_id) {
        Jenazahdocs::where('id', $jenazah_doc_id)
                    ->update([
                        'pathname' => '',
                        'status' => 1
                    ]);
        return redirect()->back();
    }

    public function documentsAccept($jenazah_doc_id) {
        Jenazahdocs::where('id', $jenazah_doc_id)->update(['status' => 2]);
        $getTrx = DB::table('trx')->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                        ->join('jenazah_docs', 'jenazah_docs.jenazah_id', '=', 'trx.jenazah_id')
                        ->join('package', 'package.id', '=', 'trx.package_id')
                        ->where('jenazah_docs.id', $jenazah_doc_id)
                        ->select('trx.user_id', 'package.price', 'trx.id')->first();
        $userId = $getTrx->user_id;
        $price  = $getTrx->price;
        $trxId    = $getTrx->id;

        $getDetailUserData = User::find($userId);
        $name  = $getDetailUserData->name;
        $email = $getDetailUserData->email;

        Mail::to($email)->send(new Sendmailable($name, $trxId, $price, 0));
        return redirect()->back()->withMsg('Email was sent to '.$email);
    }

    // payments
    public function payments() {
        return view('admin.payments');
    }

    public function paymentsReject($payment_id) {
        Payment::where('id', $payment_id)
                ->update([
                    'status' => 1 //pembayaran ditolak
                ]);
        return redirect()->back();
    }

    public function paymentsAccept($payment_id) {
        Payment::where('id', $payment_id)->update([
                    'status' => 2 //pembayaran diterima
                ]);

        $getTrx = DB::table('trx')
                ->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                ->join('sector', 'sector.trx_id', '=', 'trx.id')
                ->join('users', 'users.id', '=', 'trx.user_id')
                ->join('package', 'package.id', '=', 'trx.package_id')
                ->join('payment', 'payment.id', '=', 'trx.payment_id')
                ->where('payment.id', $payment_id)
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
        Mail::to($getTrx->email)->send(new Sendmailable(null, null, null, $getTrx, 1));
        return redirect()->back()->withMsg('Schedule was sent to '.$getTrx->email);
    }

    // detail
    public function jenazahDetail($jenazah_id) {
        $jenazah = Jenazah::find($jenazah_id);
        $doc     = Jenazahdocs::where('jenazah_id', $jenazah_id)->first();
        $data    = Trx::where('jenazah_id', $jenazah_id)->first();
        $pkgname = Package::find($data->package_id);
        $pkgname = $pkgname->name;
        $trxid   = $data->id; 
        $paymentid = $data->payment_id;
        return view('admin.detail', compact(
            'jenazah', 
            'doc', 
            'pkgname', 
            'trxid',
            'paymentid'
        ));
    }
}
