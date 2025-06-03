<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .faq-item {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        .faq-answer {
            display: none;
            padding: 10px;
            background: #e8f0ff;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Frequently Asked Questions (FAQ)</h2>

        <!-- Question 1 -->
        <div class="faq-item" onclick="toggleAnswer(1)">
            <p><strong>1. How can I book a tour?</strong></p>
            <div id="answer1" class="faq-answer">You can book a tour by clicking on the "Book Now" button on the tour details page.</div>
        </div>

        <!-- Question 2 -->
        <div class="faq-item" onclick="toggleAnswer(2)">
            <p><strong>2. What payment methods do you accept?</strong></p>
            <div id="answer2" class="faq-answer">We accept bank transfers, credit/debit cards, and cash payments.</div>
        </div>

        <!-- Question 3 -->
        <div class="faq-item" onclick="toggleAnswer(3)">
            <p><strong>3. Can I cancel my booking?</strong></p>
            <div id="answer3" class="faq-answer">Yes, cancellations are allowed up to 7 days before departure with a full refund.</div>
        </div>

        <!-- Question 4 -->
        <div class="faq-item" onclick="toggleAnswer(4)">
            <p><strong>4. Do I need a visa for these tours?</strong></p>
            <div id="answer4" class="faq-answer">No, these tours are for local destinations within Pakistan, so no visa is required.</div>
        </div>

        <!-- Question 5 -->
        <div class="faq-item" onclick="toggleAnswer(5)">
            <p><strong>5. Are meals included in the tour package?</strong></p>
            <div id="answer5" class="faq-answer">Yes, most packages include breakfast and dinner. Please check the tour details.</div>
        </div>

      

        <!-- Question 6 -->
        <div class="faq-item" onclick="toggleAnswer(6)">
            <p><strong>6. What should I pack for the tour?</strong></p>
            <div id="answer6" class="faq-answer">We recommend packing warm clothes, comfortable shoes, a power bank, sunglasses, and necessary medicines.</div>
        </div>

        <!-- Question 7 -->
        <div class="faq-item" onclick="toggleAnswer(7)">
            <p><strong>7. Is travel insurance included in the package?</strong></p>
            <div id="answer7" class="faq-answer">No, travel insurance is not included. We recommend purchasing travel insurance separately.</div>
        </div>

        <!-- Question 8 -->
        <div class="faq-item" onclick="toggleAnswer(8)">
            <p><strong>8. Are there any discounts for group bookings?</strong></p>
            <div id="answer8" class="faq-answer">Yes! We offer special discounts for groups of 5 or more people.</div>
        </div>

        <!-- Question 9 -->
        <div class="faq-item" onclick="toggleAnswer(9)">
            <p><strong>9. Will there be a guide during the tour?</strong></p>
            <div id="answer9" class="faq-answer">Yes, all our tours include an experienced guide who will provide historical and cultural insights.</div>
        </div>

        <!-- Question 10 -->
        <div class="faq-item" onclick="toggleAnswer(10)">
            <p><strong>10. What happens if the weather is bad on the tour date?</strong></p>
            <div id="answer10" class="faq-answer">In case of bad weather, we will either reschedule the tour or offer a full refund.</div>
        </div>

    </div>

    <script>
        function toggleAnswer(id) {
            var answer = document.getElementById("answer" + id);
            if (answer.style.display === "none" || answer.style.display === "") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>

</body>
</html>
