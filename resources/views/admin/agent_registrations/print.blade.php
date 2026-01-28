<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Registration - {{ $agentRegistration->full_name }}</title>
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
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header-title h1 {
            color: #1e3a8a;
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
            background-color: #f3f4f6;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: right;
        }

        .registration-id b {
            font-size: 18px;
            color: #2563eb;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-header {
            background-color: #f8fafc;
            padding: 8px 15px;
            border-left: 4px solid #2563eb;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            color: #1e40af;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item label {
            display: block;
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
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
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
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
            color: #64748b;
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

            .no-print {
                display: none;
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
            <h1>Agent Registration Profile</h1>
            <p>Official Information and Documentation Sheet</p>
        </div>
        <div class="registration-id">
            <span style="font-size: 12px; color: #64748b; display: block;">Registration ID</span>
            <b>#{{ str_pad($agentRegistration->id, 5, '0', STR_PAD_LEFT) }}</b>
        </div>
    </div>

    <div class="section">
        <div class="section-header">Personal & Contact Information</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Full Name</label>
                <div>{{ $agentRegistration->full_name }}</div>
            </div>
            <div class="info-item">
                <label>Mobile Number</label>
                <div>{{ $agentRegistration->mobile_no }}</div>
            </div>
            <div class="info-item">
                <label>Email Address</label>
                <div>{{ $agentRegistration->email }}</div>
            </div>
            <div class="info-item">
                <label>NID / ID Number</label>
                <div>{{ $agentRegistration->nid_no ?? 'N/A' }}</div>
            </div>
            <div class="info-item full-width">
                <label>Permanent Address</label>
                <div>{{ $agentRegistration->address }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">Business Information</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Business Name</label>
                <div>{{ $agentRegistration->business_name }}</div>
            </div>
            <div class="info-item">
                <label>Business Type</label>
                <div>{{ ucfirst($agentRegistration->business_type) }}</div>
            </div>
            <div class="info-item">
                <label>Years in Business</label>
                <div>{{ $agentRegistration->time_of_business }}</div>
            </div>
            <div class="info-item">
                <label>Business District</label>
                <div>{{ $agentRegistration->district }}</div>
            </div>
            <div class="info-item full-width">
                <label>Application Description (Why become an agent?)</label>
                <div>{{ $agentRegistration->description }}</div>
            </div>
        </div>
    </div>

    @php
        $attachments = [
            ['label' => 'Photo', 'field' => 'photo_up', 'multiple' => true],
            ['label' => 'Digital Sign', 'field' => 'digital_sign', 'multiple' => false],
            ['label' => 'Ref. Person Sign', 'field' => 'considerable_person_sign', 'multiple' => false],
            ['label' => 'NID Document', 'field' => 'nid_file', 'multiple' => false],
            ['label' => 'Bank Check', 'field' => 'bank_check', 'multiple' => false],
            ['label' => 'Trade License', 'field' => 'trade_license', 'multiple' => false],
        ];
    @endphp

    <div class="section">
        <div class="section-header">Verified Documents</div>
        <div class="attachments">
            @foreach($attachments as $item)
                @php
                    $files = $item['multiple']
                        ? ($agentRegistration->{$item['field']} ?? [])
                        : ($agentRegistration->{$item['field']} ? [$agentRegistration->{$item['field']}] : []);
                @endphp
                @foreach($files as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    @endphp
                    @if($isImage)
                        <div class="attachment-card">
                            <img src="{{ route('admin.agent-registrations.view-file', ['filename' => basename($file)]) }}">
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
            <p style="font-size: 10px; color: #64748b; text-align: center;">Date: {{ date('d M Y') }}</p>
        </div>
        <div>
            <div class="signature-line" style="border-top-color: #2563eb; color: #2563eb;">Authorized Officer</div>
            <p style="font-size: 10px; color: #64748b; text-align: center;">Admin Panel Seal</p>
        </div>
    </div>

</body>

</html>

</html>