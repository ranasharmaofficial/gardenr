<!DOCTYPE html>
<html>

<head>
    <title>Employee Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .page {
            width: 850px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0
        }

        .header div {
            font-size: 13px;
            margin-top: 3px
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 5px;
        }

        .section-title {
            background: #e6e6e6;
            font-weight: bold;
        }

        .photo {
            text-align: center;
        }

        .photo img {
            width: 120px;
        }

        @media print {
            .no-print {
                display: none
            }
        }
    </style>

</head>

<body>

    <div class="page">

        <div class="header">
            <h2>V2F BAJAR</h2>
            <div>Employee Full Verification Profile</div>
        </div>

        <table>

            <tr>
                <td colspan="4" class="section-title">PERSONAL INFORMATION</td>
            </tr>

            <tr>
                <td>Name</td>
                <td>{{ $user->first_name }}</td>

                <td rowspan="4" colspan="2" class="photo">
                    <img src="{{ static_asset($user->profile_pic) }}">
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
            <tr>
                <td>Gender</td>
                <td colspan="3">{{ $user->gender }}</td>
            </tr>

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
                <td >{{ $user->address }}</td>
                 <td>Pincode</td>
                <td >{{ $user->pincode }}</td>
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

            <tr>
                <td colspan="2">Verified By: __________________</td>
                <td colspan="2">Date: {{ date('d-m-Y') }}</td>
            </tr>

        </table>

        <div class="no-print" style="text-align:center;margin-top:15px">
            <button onclick="window.print()">Print</button>
        </div>

    </div>

</body>

</html>