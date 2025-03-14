<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Loan Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
        }
        .notice-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">

            <p>{{ isset($org_details->org_name)?$org_details->org_name:"" }} </p>

        </div>

        <div class="content">
            <p><span class="bold">Addressed To:</span></p>
            <p><span class="bold">MR. HARISH</span><br>
            S/O SIVA,<br>
            208 A/20, L.F. MAIN ROAD,<br>
            GUDALUR – 625518.<br>
            MOBILE: 6379574546</p>

            <div class="notice-title">
                NOTICE
            </div>

            <p>Dear Sir/Madam,</p>

            <p><span class="bold underline">Sub:</span> Ornaments Pledged by you under GL No: <span class="bold">SJ0505</span></p>
            <p>Dated 25/04/2022 for Rs. 14,000 as per the terms and conditions agreed to by you while availing of the gold loan detailed above. The loan has to be closed within 12 months.</p>
            <p>The Due Date for closure is <span class="bold">11/03/2023</span>. The total amount outstanding with the NBFCs works out to Rs. 18,000 towards principal and interest as of 11/03/2023.</p>

            <p>We hereby send intimation to call upon you to close this account on or before the due date with the applicable interest amount as of the date of closure. If necessary, you are at liberty to renew the loan by remitting up-to-date interest and other charges subject to the prevailing terms and conditions.</p>

            <p>In the event of your failure to make payment as demanded above, the NBFCs will be at liberty to dispose of the items pledged as security to the loan either in public auction or by private negotiation, either in full or in part, at your risk and responsibility.</p>

            <p>Yours faithfully,</p>
            <p><span class="bold">Manager</span></p>
            <p>Date: 11.03.2023</p>
        </div>

        <div class="footer">

            <p>{{ isset($org_details->address)?$org_details->address:"" }}</p>
        </div>
    </div>
</body>
</html>
