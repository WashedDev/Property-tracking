<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Equipment Accountability & Liability Agreement</title>
    <style>
        @page {
            margin: 100px 50px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            position: fixed;
            top: -70px;
            left: 0px;
            right: 0px;
            text-align: center;
            border-bottom: 2px solid #00AEEF;
            padding-bottom: 10px;
        }

        .logo {
            width: 180px;
        }

        .footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #ddd;
            pt-2;
        }

        .content {
            margin-top: 20px;
        }

        .recipient-info {
            margin-bottom: 30px;
            line-height: 1.2;
        }

        .subject {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .clause {
            margin-bottom: 15px;
            text-align: justify;
        }

        .clause-title {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #2D3748;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
            border: none;
        }

        .signature-table td {
            border: none;
            width: 50%;
            padding-top: 40px;
        }

        .sig-line {
            border-top: 1px solid #000;
            width: 80%;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('ctech-int-logo.png') }}" class="logo">
    </div>

    <div class="footer">
        Ctech Systems Limited | Center of Technology Innovations | Malawi | © {{ date('Y') }}
    </div>

    <div class="content">
        <div class="recipient-info">
            <strong>DATE:</strong> {{ date('d F, Y') }}<br>
            <strong>TO:</strong> {{ $user->name }}<br>
            <strong>EMAIL:</strong> {{ $user->email }}<br>
            <strong>REF:</strong> PROPERTY-LIABILITY-{{ strtoupper(Str::random(5)) }}
        </div>

        <div class="subject">Letter of Agreement: Equipment Accountability and Financial Liability</div>

        <p>Dear {{ $user->name }},</p>

        <div class="clause">
            This letter serves as a formal agreement between <strong>Ctech Systems Limited</strong> (hereinafter
            referred to as "the Company") and yourself regarding the issuance and professional use of company-owned
            assets. By accepting the items listed below, you enter into a binding financial and legal obligation to
            safeguard company property.
        </div>

        <div class="clause">
            <span class="clause-title">1. SCHEDULE OF ISSUED ASSETS:</span>
            <table>
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Model/Brand</th>
                        <th>Serial No. / Plate</th>
                        <th>Condition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->properties as $property)
                        <tr>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->model }}</td>
                            <td>{{ $property->type == 'Vehicle' ? $property->license_plate : $property->serial_number }}
                            </td>
                            <td>Excellent / Functional</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="clause">
            <span class="clause-title">2. GEOGRAPHIC & SERVICE LIMITATIONS:</span>
            The protection and maintenance of these assets are your sole responsibility 24/7. This liability extends
            **beyond working hours** and **outside company premises**. Damage, theft, or loss occurring at your
            residence, during transit, or while utilizing the equipment for off-site services is fully attributable to
            your account.
        </div>

        <div class="clause">
            <span class="clause-title">3. PENALTIES FOR DAMAGE OR LOSS:</span>
            In the event of damage resulting from negligence, unauthorized modifications, or improper handling, the
            Company reserves the right to:
            <ul>
                <li>Deduct the <strong>full current market replacement value</strong> of the item from your monthly
                    salary/remuneration.</li>
                <li>Require immediate cash reimbursement for repair costs from an authorized service provider.</li>
                <li>Initiate disciplinary action which may lead to termination of contract.</li>
            </ul>
        </div>

        <div class="clause">
            <span class="clause-title">4. LEGAL ACTION:</span>
            Failure to return the items upon request or upon termination of employment, or failure to reimburse the
            Company for lost/damaged property, will result in immediate **civil and/or criminal litigation** under the
            laws of the Republic of Malawi. The Company shall seek to recover the cost of the assets, legal fees, and
            damages for business disruption.
        </div>

        <div class="clause">
            <span class="clause-title">5. ACCEPTANCE:</span>
            By signing below, you acknowledge that you have inspected the equipment and found it in good working order,
            and you accept the terms of this liability agreement in full.
        </div>

        <table class="signature-table">
            <tr>
                <td>
                    <div class="sig-line"></div>
                    <strong>{{ $user->name }}</strong><br>
                    Employee Signature
                </td>
                <td>
                    <div class="sig-line"></div>
                    <strong>Authorized Signatory</strong><br>
                    Ctech Systems Limited
                </td>
            </tr>
        </table>
    </div>
</body>

</html>