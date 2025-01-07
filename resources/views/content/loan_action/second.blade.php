<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
        }
        .header, .footer {
            text-align: center;
            font-size: 14px;
            color: #333;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
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
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>{{ isset($org_details->org_name)?$org_details->org_name:"" }} </p>
            <p><span class="bold">Phone </span> {{ isset($org_details->mobile_number)?$org_details->mobile_number:"" }}</p>
        </div>

        <div class="notice-title">
            FINAL NOTICE<br>
            (தங்க நகைக்கடன் ஏலத்திற்கு முந்தைய அறிவிப்பு)
        </div>

        <div class="content">
            <p><span class="bold">பெறுநர்:</span> Mrs. K.MAKESWARI</p>

            <p>
                தாங்கள் எங்கள் GUDALUR I கிளையில் நகைக்கடன் படிவம் எண்
                <span class="bold">SJ 2115</span> கீழ் நகைக்கடன்
                <span class="bold">Rs. 200000/-</span> பெற்று, வாய்தா தேதி கடந்தும்
                தாங்கள் இதுவரை நகையை திருப்பி கொள்ளவில்லை. இதுவரை வட்டி ஏதும் கட்டவில்லை.
            </p>

            <p>
                இதை கண்டவுடண் 7 நாட்களுக்குள் அசல், வட்டி மற்றும் செலவு தொகைகளையும் செலுத்தி
                நகைகளை திருப்பி கொள்ளவும் அல்லது வட்டி கட்டி புதிய கணக்கில் மாற்றிவைக்கவும்.
            </p>

            <p>
                தவறும் பட்சத்தில் அரசு ஆணை உத்தரவின் கீழ் தங்கள் நகை பகிரங்க ஏலத்திற்கு
                கொண்டுவரப்படும் என அறிவித்துக்கொள்கிறோம். மேலும் ஏலத்திற்கு உட்படும்
                ஏலச்செலவு, செய்தித்தாள், விளம்பரச்செலவுகள் தங்கள் கடனுடன் சேர்க்கப்படும்.
            </p>

            <p>
                தங்கள் நகையை ஏலத்தில் விட்டு அதில் வரும் தொகை தங்கள் கணக்கிற்கு போதுமானதாக
                இல்லையென்றால், தங்கள் மீது சட்டபூர்வமான நடவடிக்கை எடுத்து வசூல் செய்யப்படும்
                என்பதையும், கணக்கு போக மீதம் இருந்தால் தங்களுக்கு தரும்பொருட்டு நிலுவையில்
                வைக்கப்படும் என்பதையும் தெரிவித்து கொள்கிறோம்.
            </p>

            <p>மேலும் இதன் தொடர்பான தகவல்களுக்கு அலுவலக தொலைபேசி எண்ணை தொடர்பு கொள்ளவும்.</p>
        </div>

        <div class="footer">
            <p><span class="bold">இப்படிக்கு</span></p>
            <p>கிளை மேலாளர்</p>
            <p>{{ isset($org_details->address)?$org_details->address:"" }}</p>
        </div>
    </div>
</body>
</html>
