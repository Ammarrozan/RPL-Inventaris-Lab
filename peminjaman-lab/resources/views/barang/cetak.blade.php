<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Barcode Barang</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            padding: 20px;
            background: #fff;
            color: #000;
        }
        .no-print-zone {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-print {
            padding: 10px 24px;
            font-size: 14px;
            font-weight: bold;
            background: #fff;
            border: 3px solid #1a1a1a;
            box-shadow: 4px 4px 0 #1a1a1a;
            cursor: pointer;
            text-transform: uppercase;
        }
        .btn-print:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #1a1a1a;
        }
        /* Grid Layout untuk Stiker Barcode */
        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .barcode-card {
            width: 240px;
            border: 3px solid #1a1a1a;
            padding: 15px;
            text-align: center;
            background: #fff;
            box-shadow: 5px 5px 0 #F0EFEA;
            border-radius: 4px;
        }
        .lab-title {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 5px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .barang-nama {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .barcode-img {
            margin: 5px 0;
        }
        .barcode-img img {
            width: 100%;
            height: 50px;
        }
        .barang-kode {
            font-size: 13px;
            font-weight: bold;
            margin-top: 6px;
            letter-spacing: 3px;
        }
        /* Aturan khusus saat cetak/print kertas */
        @media print {
            .no-print-zone {
                display: none;
            }
            body {
                padding: 0;
            }
            .barcode-card {
                box-shadow: none;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="no-print-zone">
        <button onclick="window.print()" class="btn-print">
            🖨️ Mulai Cetak Kertas / Simpan PDF
        </button>
        <p style="font-size: 12px; color: #555; margin-top: 10px;">Tips: Atur ukuran kertas ke A4 atau Label sesuai kebutuhan printer stiker lab lu.</p>
    </div>

    <div class="barcode-container">
        @foreach($barangs as $barang)
            <div class="barcode-card">
                <div class="lab-title">INVENTARIS LABORATORIUM</div>
                <div class="barang-nama">{{ $barang->nama }}</div>

                <div class="barcode-img">
                    <img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($barang->kode, $generator::TYPE_CODE_128)) }}">
                </div>

                <div class="barang-kode">{{ $barang->kode }}</div>
            </div>
        @endforeach
    </div>

</body>
</html>
