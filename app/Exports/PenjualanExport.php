<?php
namespace App\Exports;

use App\Models\Detail_produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Detail_produk::with(['produk', 'penjualan', 'penjualan.pelanggan'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Alamat Pelanggan',
            'No HP Pelanggan',
            'Nama Produk',
            'Harga Produk',
            'Qty',
            'Sub Total',
            'Tangg Pembelian',
        ];
    }

    public function map($item): array
    {
        return [
            optional($item->penjualan->pelanggan)->nama_pelanggan ?? '',
            optional($item->penjualan->pelanggan)->alamat ?? '',
            optional($item->penjualan->pelanggan)->nomor_telepon ?? '',
            optional($item->produk)->nama_produk ?? '',
            optional($item->produk)->harga ?? '',
            $item->jumlah_produk ?? '',
            $item->subtotal ?? '',
            optional(Carbon::parse($item->penjualan->tanggal_pembelian)->setTimezone('Asia/Jakarta'))->format('Y-m-d,H:i:s') ?? '',
        ];
    }
}