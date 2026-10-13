<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $transaction->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background-color: #fff;
            padding: 12px 10px;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }
        .divider {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        .double-divider {
            border-top: 2px dashed #000;
            margin: 8px 0;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .subtitle {
            font-size: 11px;
            margin-bottom: 6px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 11px;
        }
        .item-row {
            margin-bottom: 6px;
        }
        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        .item-calc {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            font-size: 12px;
        }
        .grand-total {
            font-size: 14px;
            font-weight: bold;
            margin: 4px 0;
        }
        .footer {
            margin-top: 12px;
            font-size: 11px;
            line-height: 1.4;
        }
        @media print {
            body {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }
            @page {
                margin: 0;
                size: auto;
            }
        }
    </style>
</head>
<body>
    <div class="text-center">
        <div class="title">RESTO POS</div>
        <div class="subtitle">Jl. Kuliner Lezat No. 88<br>Telp: (021) 555-8899</div>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span>No. Inv:</span>
        <span class="bold">{{ $transaction->invoice_number }}</span>
    </div>
    <div class="info-row">
        <span>Tanggal:</span>
        <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="info-row">
        <span>Kasir:</span>
        <span>{{ $transaction->user->name ?? 'Kasir' }}</span>
    </div>
    <div class="info-row">
        <span>Pelanggan:</span>
        <span>{{ $transaction->customer_name ?: 'Pelanggan Umum' }}</span>
    </div>
    <div class="info-row">
        <span>Jenis:</span>
        <span class="bold">{{ $transaction->order_type }}</span>
    </div>

    <div class="double-divider"></div>

    @foreach ($transaction->transactionDetails as $detail)
        <div class="item-row">
            <div class="item-name">{{ $detail->product->name ?? 'Menu' }}</div>
            <div class="item-calc">
                <span>{{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}</span>
                <span class="bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
    @endforeach

    <div class="divider"></div>

    <div class="total-row grand-total">
        <span>TOTAL:</span>
        <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
    </div>

    <div class="divider"></div>

    <div class="total-row">
        <span>Metode:</span>
        <span>{{ $transaction->payment_method }}</span>
    </div>
    <div class="total-row">
        <span>Bayar:</span>
        <span>Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}</span>
    </div>
    <div class="total-row">
        <span>Kembalian:</span>
        <span class="bold">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
    </div>

    <div class="divider"></div>

    <div class="text-center footer">
        <p>*** TERIMA KASIH ***</p>
        <p>Silakan datang kembali!</p>
        <p style="margin-top: 4px; font-size: 9px; color: #555;">{{ $transaction->invoice_number }}</p>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
