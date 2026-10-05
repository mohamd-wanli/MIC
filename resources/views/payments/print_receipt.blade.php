<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة إيصال - {{ optional($payment->student)->fullname ?? '' }}</title>
    <style>
        * { box-sizing: border-box; }

        @page {
            size: A4 portrait;
            margin: 5mm 8mm;
        }

        body {
            font-family: 'Arial', 'Segoe UI', Tahoma, sans-serif;
            color: #111;
            background: #f3f4f6;
            margin: 0;
            padding: 20px 10px;
            font-size: 12px;
            line-height: 1.3;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* ============== Screen toolbar ============== */
        .toolbar {
            max-width: 820px;
            margin: 0 auto 14px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .toolbar button {
            padding: 10px 26px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgba(102, 126, 234, 0.35);
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .toolbar button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.45);
        }

        /* ============== Page wrapper ============== */
        .page {
            max-width: 820px;
            margin: 0 auto;
        }

        /* ============== One receipt ============== */
        .receipt {
            background: #fff;
            border: 1.8px solid #111;
            padding: 8px 14px 6px;
            position: relative;
        }

        .receipt::after {
            content: "";
            position: absolute;
            inset: 3px;
            border: 1px solid #111;
            pointer-events: none;
        }

        /* Copy label */
        .copy-label {
            position: absolute;
            top: 5px;
            left: 10px;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .8px;
            color: #333;
            z-index: 2;
            background: #fff;
            padding: 0 6px;
            border: 1px solid #999;
            border-radius: 3px;
            line-height: 1.5;
        }

        /* ===== Header ===== */
        .header {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 8px;
            padding-bottom: 5px;
            border-bottom: 1.8px solid #111;
            position: relative;
            z-index: 1;
        }
        .header-left { text-align: right; }
        .header-left .ar-name {
            font-size: 15px;
            font-weight: 900;
            letter-spacing: -.2px;
            line-height: 1.1;
        }
        .header-left .en-name {
            font-size: 8px;
            font-weight: 700;
            letter-spacing: .4px;
            text-transform: uppercase;
            color: #333;
            margin-top: 1px;
        }
        .header-center img {
            display: block;
            height: 42px;
            width: auto;
        }
        .header-right { text-align: left; }
        .header-right .h-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 2px solid #111;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 900;
            line-height: 1;
            background: #fff;
        }

        /* ===== Body ===== */
        .body {
            padding-top: 6px;
            position: relative;
            z-index: 1;
        }

        .row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            margin-bottom: 5px;
        }
        .row.split > .col { flex: 1; min-width: 0; }

        .label {
            font-weight: 800;
            white-space: nowrap;
            font-size: 11px;
            padding-bottom: 2px;
        }

        .value {
            flex: 1;
            min-height: 18px;
            border-bottom: 1.2px dotted #111;
            padding: 0 5px 1px;
            font-weight: 700;
            font-size: 11.5px;
            color: #000;
            text-align: center;
        }

        .value.fixed-sm { flex: 0 0 90px; }
        .value.fixed-md { flex: 0 0 120px; }
        .value.fixed-lg { flex: 0 0 150px; }

        .amount-row {
            display: flex;
            align-items: flex-end;
            gap: 7px;
            margin-bottom: 6px;
        }
        .amount-row .value { text-align: center; }

        .signature-block { margin-top: 8px; }

        /* ===== Footer ===== */
        .footer {
            margin-top: 7px;
            padding-top: 5px;
            border-top: 1.8px solid #111;
            font-size: 8.5px;
            font-weight: 700;
            text-align: center;
            line-height: 1.5;
            color: #111;
            position: relative;
            z-index: 1;
        }
        .footer .branch { display: block; }
        .footer .contacts {
            margin-top: 3px;
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
            font-size: 9px;
            letter-spacing: .3px;
        }
        .footer .contacts i {
            font-style: normal;
            font-weight: 900;
            color: #667eea;
        }

        /* ===== Cut line ===== */
        .cut-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0;
            color: #999;
            font-size: 10px;
            font-weight: 700;
        }
        .cut-line::before,
        .cut-line::after {
            content: "";
            flex: 1;
            border-top: 1.3px dashed #aaa;
        }
        .cut-line span {
            white-space: nowrap;
            letter-spacing: 1px;
        }
        .cut-line .scissors { font-size: 12px; }

        /* ===== Print overrides ===== */
       @media print {
    @page {
        size: A4 portrait;
        margin: 5mm 8mm;
    }

    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        height: 100% !important;
        font-size: 12px !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .toolbar { display: none !important; }

    /* ================================================
       PAGE = FLEX COLUMN — receipts share height equally
       ================================================ */
    .page {
        max-width: 100% !important;
        margin: 0 !important;
        height: 287mm;               /* A4 (297mm) - 2×5mm margins */
        display: flex !important;
        flex-direction: column !important;
    }

    /* ================================================
       EACH RECEIPT STRETCHES TO FILL ITS SHARE
       ================================================ */
    .receipt {
        border: 1.8px solid #000 !important;
        padding: 12px 16px 10px !important;
        flex: 1 1 0 !important;       /* equal height for all 3 */
        display: flex !important;
        flex-direction: column !important;
        min-height: 0 !important;     /* required for flex shrink */
        page-break-inside: avoid !important;
    }

    /* Body fills the free space and distributes rows evenly */
    .receipt .body {
        flex: 1 1 auto !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-evenly !important;   /* spread rows */
        padding-top: 8px !important;
    }

    .receipt .body .row,
    .receipt .body .amount-row {
        margin-bottom: 0 !important;
    }

    .receipt .footer {
        margin-top: 8px !important;
        padding-top: 6px !important;
        flex-shrink: 0 !important;
    }

    .receipt .header {
        flex-shrink: 0 !important;
    }

    /* Cut lines keep their small fixed size */
    .cut-line {
        flex: 0 0 auto !important;
        margin: 3px 0 !important;
        color: #666 !important;
        font-size: 9px !important;
    }
    .cut-line::before,
    .cut-line::after {
        border-top: 1.1px dashed #666 !important;
    }

    /* ================================================
       SCALE-UP — bigger fonts to fill the space
       ================================================ */
    .header-left .ar-name    { font-size: 16px   !important; }
    .header-left .en-name    { font-size: 9px    !important; }
    .header-center img       { height: 46px      !important; }
    .header-right .h-badge   { width: 36px !important; height: 36px !important; font-size: 20px !important; }

    .label                   { font-size: 12.5px !important; padding-bottom: 3px !important; }
    .value                   { font-size: 13px   !important; min-height: 22px !important; padding: 2px 6px 2px !important; }

    .row                     { gap: 10px !important; }
    .amount-row              { gap: 8px  !important; }

    .signature-block         { margin-top: 6px !important; }

    .footer                  { font-size: 9.5px !important; }
    .footer .contacts        { font-size: 10px  !important; }

    .copy-label              { font-size: 10px  !important; padding: 1px 8px !important; }
}





    </style>

</head>
<body>

    {{-- Screen-only toolbar --}}
    <div class="toolbar">
        <button onclick="window.print()">🖨️ طباعة الإيصال (3 نسخ)</button>
    </div>

    <div class="page">

        {{-- ============================================================ --}}
        {{-- Render the receipt THREE times                              --}}
        {{-- ============================================================ --}}
        @php
            $copies = [
                'نسخة المركز (الأصل)',
                'نسخة الطالب (صورة)',
                'نسخة المحاسبة (صورة)',
            ];
        @endphp

        @foreach ($copies as $copyLabel)

            <div class="receipt">
                <span class="copy-label">{{ $copyLabel }}</span>

                {{-- ================= HEADER ================= --}}
                <div class="header">
                    <div class="header-left">
                        <div class="ar-name">مركز المأمون الدولي</div>
                        <div class="en-name">Mamoun International Center</div>
                    </div>

                    <div class="header-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>

                    <div class="header-right">
                        <span class="h-badge">H</span>
                    </div>
                </div>

                {{-- ================= BODY ================= --}}
                <div class="body">

                    {{-- Row 1: Course Name & Course Number --}}
                    <div class="row split">
                        <div class="col row" style="margin-bottom:0;">
                            <span class="label">اسم الدورة :</span>
                            <span class="value">{{ optional($payment->course)->subject_name ?? '—' }}</span>
                        </div>
                        <div class="col row" style="margin-bottom:0;">
                            <span class="label">رقم الدورة :</span>
                            <span class="value">{{ optional($payment->course)->coursenumber ?? '—' }}</span>
                        </div>
                    </div>

                    {{-- Row 2: Received from --}}
                    <div class="row">
                        <span class="label">وصلني من السيد</span>
                        <span class="value">{{ optional($payment->student)->fullname ?? '—' }}</span>
                    </div>

                    {{-- Row 3: Amount --}}
                  <div class="amount-row">
    <span class="label">مبلغ</span>
    <span class="value fixed-sm">{{ number_format((float) $payment->payment_value) }}</span>
    <span class="label">ل.س فقط</span>
    <span class="value">
        {{ \App\Helpers\NumberHelper::toWords($payment->payment_value) }}
    </span>
    <span class="label">ليرة سورية لاغير</span>
</div>
                    {{-- Row 4: Purpose --}}
                    <div class="row">
                        <span class="label">وذلك لقاء</span>
                        <span class="value">
                            {{ $payment->note ?? ($payment->payment_category ?? '—') }}
                        </span>
                    </div>

                    {{-- Row 5: Date --}}
                    <div class="row">
                        <span class="label">بتاريخ</span>
                        <span class="value fixed-md">
                            {{ $payment->collected_at ? $payment->collected_at->format('Y / m / d') : '20 /  / ' }}
                        </span>
                    </div>

                    {{-- Row 6: Course Start / Days / Hour --}}
                    <div class="row split">
                        <div class="col row" style="margin-bottom:0;">
                            <span class="label">تاريخ بدء الدورة</span>
                            <span class="value fixed-md">
                                {{ optional($payment->course)->start_date ?? '20 /  / ' }}
                            </span>
                        </div>
                        <div class="col row" style="margin-bottom:0;">
                            <span class="label">أيام الدورة</span>
                            <span class="value fixed-sm">
                                {{ optional($payment->course)->days ?? '—' }}
                            </span>
                        </div>
                        <div class="col row" style="margin-bottom:0;">
                            <span class="label">الساعة</span>
                            <span class="value fixed-md">
                                {{ optional($payment->course)->start_hour ?? '—' }}
                            </span>
                        </div>
                    </div>

                    {{-- Row 7: Name & Signature --}}
                    <div class="row signature-block">
                        <span class="label">الاسم و التوقيع :</span>
                        <span class="value">{{ optional($payment->enteredBy)->name ?? '—' }}</span>
                    </div>

                </div>

                {{-- ================= FOOTER ================= --}}
                <div class="footer">
                    <span class="branch">
                        فرع التدريب المهني : جسر فكتوريا - مقابل سوق المهني اليدوية &nbsp;|&nbsp;
                        هاتف ٢٢١٢٢٢٦ - ٢٢٤٥٩٨٧ - فاكس ٢٢٤٧١٩٦
                    </span>
                    <span class="branch">
                        فرع التدريب الفني : الحلبوني - مقابل الجامع &nbsp;|&nbsp;
                        هاتف ٢٢٤٢٤٩٩ - ٢٢٥١٣٦٦ - فاكس ٢٢٥٢٥٨٣
                    </span>
                    <div class="contacts">
                        <span><i>WebSite :</i> www.mamoun-mic.com</span>
                        <span><i>E-Mail :</i> admin@mamoun-mic.com</span>
                    </div>
                </div>
            </div>

            {{-- Cut line — only between copies, not after the last --}}
            @if (!$loop->last)
                <div class="cut-line">
                    <span class="scissors">✂</span>
                    <span>اقطع هنا</span>
                </div>
            @endif

        @endforeach

    </div>

</body>
</html>
