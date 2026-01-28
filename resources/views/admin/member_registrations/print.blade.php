<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration - {{ $memberRegistration->name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 30px;
            background-color: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header-title h1 {
            color: #065f46;
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header-title p {
            margin: 3px 0 0;
            color: #666;
            font-size: 13px;
        }

        .reg-meta {
            text-align: right;
            font-size: 13px;
        }

        .reg-meta b {
            color: #10b981;
            font-size: 16px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 180px;
            gap: 20px;
        }

        .member-photo-box {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            width: 160px;
            height: 180px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }

        .member-photo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-header {
            background-color: #f0fdf4;
            padding: 5px 12px;
            border-left: 4px solid #10b981;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            color: #065f46;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .info-item label {
            display: block;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-item div {
            font-size: 13px;
            color: #1e293b;
            font-weight: 500;
        }

        .address-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .address-col {
            background: #f9fafb;
            padding: 10px;
            border-radius: 6px;
        }

        .address-col h4 {
            margin: 0 0 8px 0;
            font-size: 11px;
            border-bottom: 1px solid #e5e7eb;
            color: #475569;
        }

        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
        }

        .sig-box {
            text-align: center;
        }

        .signature-line {
            width: 180px;
            border-top: 1px solid #333;
            padding-top: 5px;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .digital-sign-img {
            height: 40px;
            margin-bottom: 5px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media print {
            body {
                padding: 0;
            }

            @page {
                margin: 1.5cm;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">
            <h1>Member Enrollment Form</h1>
            <p>Membership Management System Official Record</p>
        </div>
        <div class="reg-meta">
            <span>Form ID</span><br>
            <b>M-{{ str_pad($memberRegistration->id, 6, '0', STR_PAD_LEFT) }}</b>
        </div>
    </div>

    <div class="main-content">
        <div class="sections-column">
            <div class="section">
                <div class="section-header">Basic Personal Details</div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Member Name</label>
                        <div>{{ $memberRegistration->name }}</div>
                    </div>
                    <div class="info-item">
                        <label>Father's Name</label>
                        <div>{{ $memberRegistration->father_name }}</div>
                    </div>
                    <div class="info-item">
                        <label>Mother's Name</label>
                        <div>{{ $memberRegistration->mother_name }}</div>
                    </div>
                    <div class="info-item">
                        <label>NID Number</label>
                        <div>{{ $memberRegistration->nid_no }}</div>
                    </div>
                    <div class="info-item">
                        <label>Mobile No</label>
                        <div>{{ $memberRegistration->phone }}</div>
                    </div>
                    <div class="info-item">
                        <label>Religion</label>
                        <div>{{ $memberRegistration->religion }}</div>
                    </div>
                    <div class="info-item">
                        <label>Nationality</label>
                        <div>{{ $memberRegistration->nationality }}</div>
                    </div>
                    <div class="info-item">
                        <label>Marital Status</label>
                        <div>{{ $memberRegistration->merital_status }}</div>
                    </div>
                    <div class="info-item">
                        <label>Family Members</label>
                        <div>{{ $memberRegistration->family_member_num }}</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-header">Address Information</div>
                <div class="address-box">
                    <div class="address-col">
                        <h4>Permanent Address</h4>
                        <div class="info-grid" style="grid-template-columns: 1fr 1fr;">
                            <div class="info-item"><label>Village</label>
                                <div>{{ $memberRegistration->village_permanent }}</div>
                            </div>
                            <div class="info-item"><label>Post</label>
                                <div>{{ $memberRegistration->post_name_permanent }}</div>
                            </div>
                            <div class="info-item"><label>Thana</label>
                                <div>{{ $memberRegistration->thana_upozilla_permanent }}</div>
                            </div>
                            <div class="info-item"><label>District</label>
                                <div>{{ $memberRegistration->district_permanent }}</div>
                            </div>
                            <div class="info-item"><label>Post Code</label>
                                <div>{{ $memberRegistration->post_code_permanent }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="address-col">
                        <h4>Present Address</h4>
                        <div class="info-grid" style="grid-template-columns: 1fr 1fr;">
                            <div class="info-item"><label>Road/Village</label>
                                <div>{{ $memberRegistration->road_present }}</div>
                            </div>
                            <div class="info-item"><label>Post</label>
                                <div>{{ $memberRegistration->post_name_present }}</div>
                            </div>
                            <div class="info-item"><label>Thana</label>
                                <div>{{ $memberRegistration->thana_upozilla_present }}</div>
                            </div>
                            <div class="info-item"><label>District</label>
                                <div>{{ $memberRegistration->district_present }}</div>
                            </div>
                            <div class="info-item"><label>Post Code</label>
                                <div>{{ $memberRegistration->post_code_present }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-header">Sponsor / Reference</div>
                <div class="info-grid" style="grid-template-columns: 1fr 1fr;">
                    <div class="info-item">
                        <label>Sponsor Name</label>
                        <div>{{ $memberRegistration->sponsor_name }}</div>
                    </div>
                    <div class="info-item">
                        <label>Sponsor Contact</label>
                        <div>{{ $memberRegistration->sponsor_phone }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="photo-column">
            <div class="member-photo-box">
                @if($memberRegistration->image)
                    <img src="{{ route('admin.member-registrations.view-file', ['filename' => basename($memberRegistration->image)]) }}"
                        alt="Member Photo">
                @else
                    <div style="color: #cbd5e1; font-size: 12px;">PHOTO</div>
                @endif
            </div>
            <div style="margin-top: 15px; text-align: center;">
                <label style="font-size: 10px; color: #64748b; font-weight: 600;">ENROLLMENT DATE</label>
                <div style="font-size: 13px;">{{ $memberRegistration->created_at->format('d M Y') }}</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="sig-box">
            @if($memberRegistration->digital_sign)
                <img src="{{ route('admin.member-registrations.view-file', ['filename' => basename($memberRegistration->digital_sign)]) }}"
                    class="digital-sign-img">
            @else
                <div style="height: 40px;"></div>
            @endif
            <div class="signature-line">Member Signature</div>
        </div>
        <!-- <div class="sig-box">
            <div style="height: 40px;"></div>
            <div class="signature-line">Supervisor Signature</div>
        </div>
        <div class="sig-box">
            <div style="height: 40px;"></div>
            <div class="signature-line">Issued By (Admin)</div>
        </div> -->
    </div>

</body>

</html>

</html>