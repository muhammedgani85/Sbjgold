<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Loan Release Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
            font-size:12px;
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
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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
    body {
        font-size: 12px;
    }

    /* Ensure high specificity */
    body .header, body .footer {
        text-align: center !important;
        padding: 10px !important;
        background-color: #004085 !important;
        color: #fff !important;
        border-radius: 8px 8px 0 0 !important;
    }

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
        <h2>{{ isset($branch_detail->org_name)?$branch_detail->org_name:"Empty" }}</h2>
    </div>

    <!-- Title -->
    <h3 style="text-align: center; margin-top: 20px;">Gold Loan Release Letter</h3>
    <p>Date: {{ date('d-m-Y') }}</p>

    <div align="right" style="padding-right:100px;">
        <img src="{{ asset('storage/' . $customer->customer_photo) }}" alt="Image" style="width:50px; height:50px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="{{ asset('storage/' . $loan->customer_other) }}" alt="Image" style="width:50px; height:50px;">
    </div>

    <!-- Customer and Loan Details -->
    <table>
        <tr>
            <th>Customer Name</th>
            <td>{{ isset($customer->first_name)?$customer->first_name." ".$customer->last_name:"" }}</td>
        </tr>
        <tr>
            <th>Loan Number</th>
            <td>{{ isset($loan->loan_number)?$loan->loan_number:"" }}</td>
        </tr>
        <tr>
            <th>Loan Amount</th>
            <td>{{ isset($loan->total_loan_amount)?$loan->total_loan_amount:"" }}</td>
        </tr>
        <tr>
            <th>Interest</th>
            <td>{{ isset($loan->interest_per)?$loan->interest_per:"" }}</td>
        </tr>
        <tr>
            <th>Waive-Off</th>
            <td>NILL</td>
        </tr>
        <tr>
            <th>Release Date</th>
            <td>{{ isset($loan->updated_at)?$loan->updated_at:"" }}</td>
        </tr>
    </table>

    <!-- Terms and Conditions -->
    <div class="terms">
        <h4>Terms and Conditions:</h4>
        <ul>
            <li>The loan is considered released upon the confirmation of this document.</li>
            <li>The customer is responsible for the repayment of the principal amount and any applicable interest.</li>
            <li>XYZ Gold Finance reserves the right to take legal action in case of non-repayment.</li>
            <li>This release is subject to the terms agreed upon at the time of loan initiation.</li>
            <li>All disputes are subject to the jurisdiction of the city courts.</li>
        </ul>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature">
            <p>Authorized Signatory</p>
        </div>
        <div class="signature">
            <p>Customer Signature</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>{{ isset($branch_detail->address)?$branch_detail->address:"" }}.Phone : {{ isset($branch_detail->mobile_number)?$branch_detail->mobile_number:"" }} </p>
        <p>www.sbjgoldfinance.com</p>
    </div>

    <!-- Print Button -->
    <div style="text-align: center; margin-top: 20px;" id='print_button'>
        <button onclick="printPage()">Print Letter</button>
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

<!-- CSS to hide unnecessary elements during print -->



</body>
</html>
