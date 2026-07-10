<!DOCTYPE html>
<html>

<head>
    <title>Employee Profile</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            background: #f5f5f5;
            padding: 10px;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            max-height: 297mm;
            margin: 0 auto;
            padding: 15px 20px;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 3px double #2c3e50;
        }

        .logo {
            height: 55px;
            width: auto;
        }

        .header-info {
            flex: 1;
            text-align: right;
        }

        .header-info h2 {
            color: #2c3e50;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }

        .header-info .subtitle {
            font-size: 12px;
            color: #7f8c8d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-top-line {
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #2c3e50, #3498db, #2c3e50);
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            border: 1px solid #dfe6e9;
            padding: 6px 10px;
            vertical-align: middle;
        }

        td:first-child {
            font-weight: 600;
            color: #2c3e50;
            background: #f8f9fa;
            width: 25%;
        }

        .section-title {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px !important;
            border: none !important;
        }

        .photo {
            text-align: center;
            background: #f8f9fa;
        }

        .photo img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            border: 3px solid #3498db;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .footer-section {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 2px solid #ecf0f1;
        }

        .signature-box {
            flex: 1;
            padding: 10px;
            margin: 0 5px;
            border: 1px solid #dfe6e9;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .signature-box label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 10px;
        }

        .signature-line {
            border-bottom: 1px solid #2c3e50;
            margin-bottom: 5px;
        }

        .no-print {
            text-align: center;
            margin-top: 15px;
        }

        .no-print button {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border: none;
            padding: 12px 35px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
            transition: all 0.3s ease;
        }

        .no-print button:hover {
            background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .page {
                box-shadow: none;
                width: 100%;
                padding: 10mm;
                margin: 0;
            }

            .no-print {
                display: none;
            }

            @page {
                size: A4;
                margin: 10mm;
            }
        }
    </style>

</head>

<body>

    <div class="page">

        <div class="header-top-line"></div>

        <div class="header">
            <img src="https://v2fbaazar.com/public/uploads/logo/logo-20251203175657-5871.webp" alt="V2F Bajar Logo" class="logo">
            <div class="header-info">
                <h2>V2F BAJAR</h2>
                <div class="subtitle">Employee Full Verification Profile</div>
            </div>
        </div>

        <table>

            <tr>
                <td colspan="4" class="section-title">PERSONAL INFORMATION</td>
            </tr>

            <tr>
                <td>Name</td>
                <td>{{ $user->first_name }}</td>

                <td rowspan="4" colspan="2" class="photo">
                    <img src="{{ static_asset($user->profile_pic) }}" alt="Employee Photo">
                </td>
            </tr>

            <tr>
                <td>Employee Code</td>
                <td>{{ $user->employee_code }}</td>
            </tr>

            <tr>
                <td>Phone</td>
                <td>{{ $user->mobile }}</td>
            </tr>

            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <td>Gender</td>
                <td colspan="3">{{ $user->gender }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">OFFICIAL INFORMATION</td>
            </tr>
            <tr>
                <td>User Type</td>
                <td colspan="3">{{ $user->user_type_name }}</td>
            </tr>
            <tr>
                <td>Branch</td>
                <td colspan="3">{{ $user->branch_name }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="3">{{ $user->status ? 'Active' : 'Inactive' }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">ADDRESS</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $user->address }}</td>
                <td>Pincode</td>
                <td>{{ $user->pincode }}</td>
            </tr>

            <tr>
                <td>State</td>
                <td>{{ $user->state_name }}</td>
                <td>City</td>
                <td>{{ $user->city_name }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">BANK DETAILS</td>
            </tr>
            <tr>
                <td>Account No</td>
                <td>{{ $user->account_number }}</td>
                <td>IFSC</td>
                <td>{{ $user->ifsc_code }}</td>
            </tr>
            <tr>
                <td>Bank</td>
                <td>{{ $user->bank_name }}</td>
                <td>Branch</td>
                <td>{{ $user->branch_name }}</td>
            </tr>
            <tr>
                <td>UPI</td>
                <td colspan="3">{{ $user->upi_details }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">WORK DETAILS</td>
            </tr>

            <tr>
                <td>Experience</td>
                <td>{{ $user->experience }}</td>
                <td>Working Hour</td>
                <td>{{ $user->working_hour }}</td>
            </tr>

            <tr>
                <td>In Time</td>
                <td>{{ $user->in_time }}</td>
                <td>Salary</td>
                <td>{{ $user->salary }}</td>
            </tr>

            <tr>
                <td>Training Fee</td>
                <td>{{ $user->training_fee }}</td>
                <td>Session</td>
                <td>{{ $user->session_name }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">FACILITIES & INCENTIVES</td>
            </tr>
            <tr>
                <td>Uniform</td>
                <td>{{ $user->uniform }}</td>
                <td>Shoe</td>
                <td>{{ $user->shoe }}</td>
            </tr>
            <tr>
                <td>Coat</td>
                <td>{{ $user->coat }}</td>
                <td>Training</td>
                <td>{{ $user->training }}</td>
            </tr>
            <tr>
                <td>I Card</td>
                <td>{{ $user->i_card }}</td>
                <td>Insurance</td>
                <td>{{ $user->insurance }}</td>
            </tr>
            <tr>
                <td>Security</td>
                <td>{{ $user->security_money }}</td>
                <td>Staff Incentive</td>
                <td>{{ $user->staff_incentive }}</td>
            </tr>

            <tr>
                <td colspan="4" class="section-title">ASSIGNED OFFICERS</td>
            </tr>
            <tr>
                <td>Reporting Officer</td>
                <td>{{ $user->reporting_officer_name }}</td>
                <td>Trainer Officer</td>
                <td>{{ $user->trainer_officer_name }}</td>
            </tr>
            <tr>
                <td>Home Verification</td>
                <td>{{ $user->home_verification_officer_name }}</td>
                <td>Junior Office</td>
                <td>{{ $user->junior_office_employee_name }}</td>
            </tr>

        </table>

        <div class="footer-section">
            <div class="signature-box">
                <label>Verified By:</label>
                <div class="signature-line"></div>
            </div>
            <div class="signature-box">
                <label>Date:</label>
                <div>{{ date('d-m-Y') }}</div>
            </div>
        </div>

        <div class="no-print">
            <button onclick="window.print()">🖨️ Print Profile</button>
        </div>

    </div>

</body>

</html>