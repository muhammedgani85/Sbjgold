<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Interest Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-title {
            font-size: 1rem;
            font-weight: bold;
        }
        .invoice {
            padding: 30px;
        }
        .invoice img {
            max-width: 120px;
        }
        .table td, .table th {
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .customer-details {
            padding-left: 30px;
        }
        .company-logo {
            text-align: center;
            margin-bottom: 5px;
        }
        .company-info {
            text-align: center;
            font-size: 12px;
            color: #555;
        }
        .company-logo img {
            max-width: 150px;
        }
        h6{
          font-weight: bolder;
        }
        /* Hide the print button when printing */
        @media print {
        body {
            font-size: 12px;
        }

        /* Ensure rows and columns follow the layout for print */
        .row {
            display: flex;
            flex-wrap: nowrap;
        }

        .col-md-6 {
            flex: 1;
        }

        /* Table styles for print */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        /* Hide elements with no-print class */
        .no-print {
            display: none;
        }

        /* Page settings */
        @page {
            size: A4 portrait;
            margin: 10mm;
        }



}
    </style>
</head>
<body>

<div class="container mt-5 invoice" id="invoiceContent">
    <!-- Company Logo Section -->
    <div class="row">
        <div class="col-md-12 company-logo">
            <img src="http://127.0.0.1:8000/assets/images/sj_logo.png" alt="Company Logo">
        </div>
        <!-- Company Info Section -->
        <div class="col-md-12 company-info">
            <p>123 Main Street, Springfield, USA | Phone: +1 234 567 890 | Email: info@company.com</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <p><strong>Invoice No:</strong> #INV-12345</p>
            <p><strong>Issue Date:</strong> October 10, 2024</p>
        </div>
        <div class="col-md-2 text-end">
        <img src="{{ asset('storage/' . $interst_list->photo) }}" alt="Image" style="width:100px; height:100px;">
        </div>
    </div>

    <div class="row mt-4">
    <!-- Customer Details -->
    <div class="col-md-6">

        <p><strong>Name:</strong> {{ $interst_list->first_name." ".$interst_list->last_name }} </p>
        <p><strong>Customer ID:</strong> {{ $interst_list->customer_id }}</p>
        <p><strong>Address:</strong> {{ $interst_list->communication_address }}</p>
        <p><strong>Phone:</strong> +91 {{ $interst_list->customer_contact }}</p>
    </div>

    <!-- Loan Details -->
    <div class="col-md-6">

        <p><strong>Loan Number:</strong> {{ $interst_list->loan_number }}</p>
        <p><strong>Loan Date:</strong> {{ $interst_list->created_at }}</p>
        <p><strong>Loan Amount:</strong> {{ $interst_list->total_loan_amount }}</p>
    </div>
</div>


    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Interest Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Interest Amount</th>
                        <th>Payment Status</th>
                        <th>Mode</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $interst_list->month}}</td>
                        <td>{{ $interst_list->interest_amount}}</td>
                        <td>Paid</td>
                        <td>{{ $interst_list->payment_method}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div>
<p><strong>1. Payment Schedule:</strong> Interest payments must be made according to the agreed schedule as outlined in the loan agreement. Any deviations require prior approval.</p>

<p><strong>2. Late Payment Penalties:</strong> Late payments will incur additional charges as specified in the loan agreement. These charges are non-refundable and will compound if not paid promptly.</p>

<p><strong>3. Interest Rate Changes:</strong> The interest rate is fixed unless otherwise stated in the agreement. Variable rates, if applicable, will fluctuate based on market conditions or index rates.</p>

<p><strong>4. Prepayment Policy:</strong> Borrowers may prepay the loan without incurring additional charges, unless specified otherwise. Any prepayment will first be applied to outstanding interest before reducing the principal balance.</p>

<p><strong>5. Default Terms:</strong> Failure to comply with payment terms may result in loan default. In such cases, additional legal actions or repossession of collateral may apply as per the terms of the agreement.</p>

    </div>

    <div class="row mt-4">

        <div class="col-md-6 text-end no-print">
            <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript function to print the invoice -->
<script>
    function printInvoice() {
        window.print(); // Trigger the browser's print functionality
    }
</script>
</body>
</html>
