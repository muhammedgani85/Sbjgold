<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Loan Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
            font-size: 11px;
        }
        .container {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
            background-color: #004085;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }
        .footer {
            border-radius: 0 0 8px 8px;
            font-size: 0.8em;
        }
        .terms {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #004085;
            color: white;
        }
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
            width: 45%;
        }
        @media print {
            #print_button {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="container" id="printableContent">
    <!-- Header -->
    <div class="header">
        <img src="{{ asset('assets/images/sj_logo.png') }}" alt="Logo" style="width:150px; height:50px;">
       <!--  <h2>{{ isset($branch_detail->org_name) ? $branch_detail->org_name : "Empty" }}</h2> -->
    </div>

    <!-- Title -->
    <h3 style="text-align: center; margin-top: 20px;">Sanction Letter cum with Gold Loan Pledge Receipt</h3>
    <p style="text-align: right;">Print Date & TIme: {{ date('d-m-Y H:m:s') }}</p>

    <div align="right" style="padding-right:100px;">
        <img src="{{ asset('storage/' . $customer->customer_photo) }}" alt="Customer Image" style="width:50px; height:50px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="{{ asset('storage/' . $loan->customer_photo) }}" alt="Loan Image" style="width:50px; height:50px;">
    </div>

    <!-- Customer and Loan Details in a Single Row Table -->
     <div>Loan Details</div>
    <table>
        <tr>
            <th>Customer Name</th>
            <th>Loan Number</th>
            <th>Gross Weight</th>
            <th>Net Weight</th>

            <th>Loan Amount</th>
            <th>Interest</th>
            <th>Remarks</th>
            <th>Loan Date</th>
        </tr>
        <tr>
            <td>{{ isset($customer->first_name) ? $customer->first_name . " " . $customer->last_name : "" }}</td>
            <td>{{ isset($loan->loan_number) ? $loan->loan_number : "" }}</td>

            <td>{{ isset($loan->jewel_grams) ? $loan->jewel_grams : "" }}</td>
            <td>{{ isset($loan->jewel_net_grams) ? $loan->jewel_net_grams : "" }}</td>


            <td>₹{{ isset($loan->total_loan_amount) ? number_format($loan->total_loan_amount, 2) : "" }}</td>
            <td>{{ isset($loan->interest_per) ? $loan->interest_per : "" }}%</td>
            <td>{{ isset($loan->remarks) ? $loan->remarks : "" }}</td>
            <td>{{ isset($loan->created_at) ? date('d-m-Y', strtotime($loan->created_at)) : "" }}</td>
        </tr>
    </table>
<p>Scheme & Other Details</p>
    <table>
        <tr>
            <th>Scheme</th>
            <th>Principal Due Date</th>
            <th>Min no of Days Interest</th>
            <th>Period Of Loan</th>

            <th>Payment Mode</th>

        </tr>
        <tr>
        <td>{{ isset($loan->interest_month) ? $loan->interest_month : "" }} Month</td>
        <td>{{ isset($loan->created_at) ? date('d-m-Y', strtotime($loan->created_at . ' +365 days')) : "" }}</td>

            <td>7 Days</td>
            <td>{{ isset($loan->interest_month) ? $loan->interest_month : "" }} Month</td>

            <td>Cash</td>

        </tr>
    </table>




        <div>Releatable for Interest payment is available as below,if up to date interest is paid</div>
    <table>
        <tr>
            <th>If Paid within</th>
            <th>Rebate*</th>
            <th>Effective ROI</th>

        </tr>
        @if(isset($interest_details))
        @foreach ($interest_details as $interest )


        <tr>
            <td>{{ isset($interest->months) ? $interest->months ." Month" : "" }}</td>
            <td>{{ isset($interest->interest_percentage) ? $interest->interest_percentage."% p/a" : "" }}</td>
            <td>{{ isset($interest->interest_percentage) ? $interest->interest_percentage."% p/a" : "" }}</td>

        </tr>
        @endforeach
        @endif
    </table>



    <div>#All Kind of Charges (Inc GST 18%)</div>
    <table>
        <tr>
            <th>Document Charge *</th>
            <th>CAC Charge</th>
            <th>SMS Charges *</th>
            <th>Security Charges *</th>
            <th>Stamp Duty *</th>

        </tr>



        <tr>
            <td>Rs {{ isset($loan->document_charge) ? $loan->document_charge : "" }}/-</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>

    </table>

    <!-- Terms and Conditions -->
    <!-- <div class="terms">
        <h4>Terms and Conditions:</h4>
        <ul>
            <li>The loan is considered released upon the confirmation of this document.</li>
            <li>The customer is responsible for the repayment of the principal amount and any applicable interest.</li>
            <li>SJ Gold Finance reserves the right to take legal action in case of non-repayment.</li>
            <li>This release is subject to the terms agreed upon at the time of loan initiation.</li>
            <li>All disputes are subject to the jurisdiction of the city courts.</li>
        </ul>
    </div> -->

    <p>I agree to repay the principal amount along with applicable interest as per the agreed terms and conditions.</p>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature">
            <p>Signature of the Manager</p>
        </div>
        <div class="signature">
            <p>Signature of the Borrower</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>{{ isset($branch_detail->address) ? $branch_detail->address : "" }}. Phone: {{ isset($branch_detail->mobile_number) ? $branch_detail->mobile_number : "" }} &nbsp;www.sbjgoldfinance.com</p>

    </div>

    <!-- Print Button -->
    <div style="text-align: center; margin-top: 20px;" id='print_button'>
        <button onclick="printPage()">Print Receipt</button>
    </div>
</div>

<!-- JavaScript for Printing -->
<script>
    function printPage() {
        var content = document.getElementById('printableContent').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>

</body>
</html>
