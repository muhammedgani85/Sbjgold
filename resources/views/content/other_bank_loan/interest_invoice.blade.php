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
            .no-print {
                display: none;
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
        <div class="col-md-6 text-end">
            <img src="customer-image.jpg" alt="Customer Image" class="img-thumbnail">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h6>Customer Details</h6>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Customer ID:</strong> CUST-001</p>
            <p><strong>Address:</strong> 1234 Elm St, Springfield, USA</p>
            <p><strong>Phone:</strong> +1 234 567 890</p>
        </div>
        <div class="col-md-6">
            <h6>Loan Details</h6>
            <p><strong>Loan Number:</strong> LOAN-987654</p>
            <p><strong>Loan Date:</strong> January 15, 2024</p>
            <p><strong>Loan Amount:</strong> $10,000</p>
            <p><strong>Interest Rate:</strong> 5% per month</p>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>January</td>
                        <td>$500</td>
                        <td>Paid</td>
                    </tr>

                </tbody>
            </table>
        </div>
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
