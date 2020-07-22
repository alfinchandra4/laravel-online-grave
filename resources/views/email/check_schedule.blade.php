@if ($status != null)
    <div>
        <p>Halo {{ $ahliwaris }}, Pembayaran untuk pesanan no. {{ $transaction_id }} Sebesar Rp. {{number_format($pkg_price)}} berhasil diterima</p>
    </div>
@endif
<div>
    Jadwal pemakaman wakaf bungur
    <table>
        <tr>
            <th>Ahliwaris</th>
            <td>:</td>
            <td>{{ $ahliwaris }}</td>
        </tr>
        <tr>
            <th>Jenazah</th>
            <td>:</td>
            <td>{{ $jenazah }}</td>
        </tr>
        <tr>
            <th>Identitas</th>
            <td>:</td>
            <td>{{ $identitas }}</td>
        </tr>
        <tr>
            <th>Jenis kelamin</th>
            <td>:</td>
            <td>{{ $jk }}</td>
        </tr>
        <tr>
            <th>Lahir</th>
            <td>:</td>
            <td>{{ date('d/m/Y', strtotime($lahir)) }}</td>
        </tr>
        <tr>
            <th>Wafat</th>
            <td>:</td>
            <td>{{ date('d/m/Y', strtotime($mati)) }}</td>
        </tr>
        <tr>
            <th>Lokasi makam</th>
            <td>:</td>
            <td>{{ $blok }}</td>
        </tr>
    </table> 
    Note: Silahkan datang ke makam pada pukul {{ $dikubur }} dan menghubungi bagian admin makam. <br/>
    <b>Terimakasih</b>
</div>