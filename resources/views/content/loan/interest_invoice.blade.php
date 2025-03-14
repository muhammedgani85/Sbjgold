<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Interest Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 12px;
            margin: 20px;
            background: #f8f9fa;
        }
        .invoice {
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .company-logo img {
            max-width: 150px;
        }
        .company-info {
            text-align: center;
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
            text-align: center;
        }
        .signature {
            margin-top: 50px;
        }
        .signature div {
            border-top: 1px solid #000;
            width: 200px;
            text-align: center;
            margin: auto;
            padding-top: 5px;
        }
        .no-print {
            text-align: center;
            margin-top: 20px;
        }
        @media print {
    body {
        font-size: 12px;
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact;
    }
    .invoice {
        border: none;
        box-shadow: none;
        padding: 30px;
    }
    .no-print {
        display: none;
    }
    @page {
        size: A4;
        margin: 15mm;
    }
    /* Prevent breaking of customer & loan details */
    .row {
        display: flex;
        flex-wrap: nowrap;
        page-break-inside: avoid;
    }
    .col-md-6 {
        width: 50%;
        box-sizing: border-box;
    }
}

    </style>
</head>
<body>

<div class="container invoice" id="invoiceContent">
    <div class="text-center company-logo">
        <img src="http://training.sjgoldfinance.com/assets/images/sj_logo.png" alt="Company Logo">
    </div>
    <div class="company-info">
        <p>{{ isset($branch_details)?$branch_details->address:"" }} | Phone: +91 {{ isset($branch_details)?$branch_details->mobile_number:"" }}</p>
    </div>

    <div class="row mb-3">
        <div class="col-sm-6">
            <p><strong>Invoice No:</strong> {{ $interst_list->loan_number }}-{{$interst_list->month}} </p>
        </div>
        <div class="col-sm-6 text-sm-end">
            <p><strong>Issue Date:</strong> {{ date('d-m-Y') }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <p><strong>Customer ID:</strong> {{ $interst_list->customer_id }}</p>
            <p><strong>Name:</strong> {{ $interst_list->first_name." ".$interst_list->last_name }}</p>
            <p><strong>Phone:</strong> +91 {{ $interst_list->customer_contact }}</p>
            <p><strong>Address:</strong> {{ $interst_list->communication_address }}</p>
            <p><strong>Branch:</strong> {{ isset($branch_details)?$branch_details->branch_name:"" }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Loan Number:</strong> {{ $interst_list->loan_number }}</p>
            <p><strong>Loan Date:</strong> {{ $interst_list->created_at }}</p>
            <p><strong>Loan Amount:</strong> {{ $interst_list->total_loan_amount }}</p>
            <p><strong>Gross Weight:</strong> {{ $interst_list->jewel_net_grams }}</p>
            <p><strong>Net Weight:</strong> {{ $interst_list->jewel_grams }}</p>
            <p><strong>Maturity Date:</strong> {{ date('d-m-Y', strtotime($interst_list->created_at. ' + '.$interst_list->interest_month.' months')) }}</p>
            <p><strong>Scheme:</strong> {{ $interst_list->type }}</p>
        </div>
    </div>

    <h5 class="mt-4">Transaction Details</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Amount</th>

                    <th>Mode</th>
                </tr>
            </thead>
            <tbody>
                <tr align="center">
                <td>{{ date('M', mktime(0, 0, 0, $interst_list->month, 1)) }}</td>
                    <td>{{ $interst_list->interest_amount }}</td>

                    <td>{{ $interst_list->payment_method }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h5 class="mt-4">Terms & Conditions</h5>
    <ul>
        <li><strong>Payment Schedule:</strong> Interest payments must be made according to the agreed schedule as outlined in the loan agreement.</li>
        <li><strong>Late Payment Penalties:</strong> Late payments will incur additional charges as specified in the loan agreement.</li>
        <li><strong>Interest Rate Changes:</strong> The interest rate is fixed unless otherwise stated in the agreement.</li>
        <li><strong>Prepayment Policy:</strong> Borrowers may prepay the loan without additional charges unless specified otherwise.</li>
        <li><strong>Default Terms:</strong> Failure to comply with payment terms may result in loan default and legal action.</li>
    </ul>

    <div class="signature text-center">
        <div>Authorized Signature</div>
    </div>

    <div class="no-print">
        <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
    </div>
</div>

<script>
    function printInvoice() {
        window.print();
    }
</script>
</body>
</html>
