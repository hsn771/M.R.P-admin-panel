<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Agent Registration - {{ $subAgentRegistration->full_name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
            background-color: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ea580c;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header-title h1 {
            color: #9a3412;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-title p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }

        .registration-id {
            background-color: #fff7ed;
            padding: 10px 20px;
            border: 1px solid #ffedd5;
            border-radius: 8px;
            text-align: right;
        }

        .registration-id b {
            font-size: 18px;
            color: #ea580c;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-header {
            background-color: #fff7ed;
            padding: 8px 15px;
            border-left: 4px solid #ea580c;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            color: #c2410c;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item label {
            display: block;
            font-size: 11px;
            color: #9a3412;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .info-item div {
            font-size: 15px;
            color: #1e293b;
            font-weight: 500;
        }

        .full-width {
            grid-column: span 2;
        }

        .attachments {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .attachment-card {
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #fff;
        }

        .attachment-card img {
            max-width: 100%;
            height: 100px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .attachment-card span {
            display: block;
            font-size: 10px;
            color: #c2410c;
            font-weight: 600;
            text-transform: uppercase;
        }

        .footer {
            margin-top: 100px;
            display: flex;
            justify-content: space-between;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid #333;
            text-align: center;
            padding-top: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        @media print {
            body {
                padding: 0;
            }

            @page {
                margin: 2cm;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">
            <h1>Sub-Agent Record Sheet</h1>
            <p>Official Network Representative Documentation</p>
        </div>
        <div class="registration-id">
            <span style="font-size: 12px; color: #9a3412; display: block;">File ID</span>
            <b>#SA-{{ str_pad($subAgentRegistration->id, 5, '0', STR_PAD_LEFT) }}</b>
        </div>
    </div>

    <div class="section">
        <div class="section-header">Core Identity Details</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Full Name</label>
                <div>{{ $subAgentRegistration->full_name }}</div>
            </div>
            <div class="info-item">
                <label>Mobile Number</label>
                <div>{{ $subAgentRegistration->mobile_no }}</div>
            </div>
            <div class="info-item">
                <label>Email Address</label>
                <div>{{ $subAgentRegistration->email }}</div>
            </div>
            <div class="info-item">
                <label>District</label>
                <div>{{ $subAgentRegistration->district }}</div>
            </div>
            <div class="info-item">
                <label>NID / ID No</label>
                <div>{{ $subAgentRegistration->nid_no ?? 'N/A' }}</div>
            </div>
            <div class="info-item">
                <label>Registration Date</label>
                <div>{{ $subAgentRegistration->created_at->format('d M Y') }}</div>
            </div>
            <div class="info-item full-width">
                <label>Full Address</label>
                <div>{{ $subAgentRegistration->address }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">Applicant Statement / Description</div>
        <div
            style="font-size: 14px; background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #f1f5f9;">
            {{ $subAgentRegistration->description }}
        </div>
    </div>

    @php
        $attachments = [
            ['label' => 'Photo', 'field' => 'photo_up', 'multiple' => true],
            ['label' => 'Digital Sign', 'field' => 'digital_sign', 'multiple' => false],
            ['label' => 'Ref. Person Sign', 'field' => 'considerable_person_sign', 'multiple' => false],
            ['label' => 'NID Document', 'field' => 'nid_file', 'multiple' => false],
            ['label' => 'Chairman Cert.', 'field' => 'chairman_certificate', 'multiple' => false],
            ['label' => 'Birth Cert.', 'field' => 'birth_certificate', 'multiple' => false],
        ];
    @endphp

    <div class="section">
        <div class="section-header">Supporting Documents</div>
        <div class="attachments">
            @foreach($attachments as $item)
                @php
                    $files = $item['multiple']
                        ? ($subAgentRegistration->{$item['field']} ?? [])
                        : ($subAgentRegistration->{$item['field']} ? [$subAgentRegistration->{$item['field']}] : []);
                @endphp
                @foreach($files as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    @endphp
                    @if($isImage)
                        <div class="attachment-card">
                            <img src="{{ route('admin.sub-agent-registrations.view-file', ['filename' => basename($file)]) }}">
                            <span>{{ $item['label'] }}</span>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="footer">
        <div>
            <div class="signature-line">Applicant's Signature</div>
            <p style="font-size: 10px; color: #666; text-align: center;">Verified Identity</p>
        </div>
        <div>
            <div class="signature-line" style="border-top-color: #ea580c; color: #ea580c;">Agent Head Seal</div>
            <p style="font-size: 10px; color: #666; text-align: center;">M.R.P Admin Official</p>
        </div>
    </div>

</body>

</html>

</html>