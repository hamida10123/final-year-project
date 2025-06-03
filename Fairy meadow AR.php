



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seasons Selector</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        .buttons {
            margin: 20px;
        }

        button {
            padding: 12px 25px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 50px; /* Oval shape */
            background-color: #001399; /* Button color */
            color: white;
            transition: 0.3s;
        }

        button:hover {
            opacity: 0.8;
            transform: scale(1.05); /* Slight enlarge on hover */
        }

        #season-image {
            display: none;
            margin-top: 20px;
            max-width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease;
            margin-left: auto;
            margin-right: auto;
            opacity: 0;
        }

        .zoom-buttons {
            margin-top: 10px;
            display: none; /* Hidden initially */
        }
    </style>
</head>
<body>

    <h2>Select a Season to View</h2>


    
   
    


    <div class="buttons">
        <button onclick="showImage('Fairy Meadow Summer.jpg')">Summer</button>
        <button onclick="showImage('Fairy Meadow Winter.jpg')">Winter</button>
        <button onclick="showImage('Fairy Meadow Autumn.jpg')">Autumn</button>
        <button onclick="showImage('Fairy Meadow Spring.jpg')">Spring</button>
    </div>

    <img id="season-image" src="/fyp/uploads/" alt="Season Image">

    <div class="zoom-buttons">
        <button onclick="zoomIn()">Zoom In</button>
        <button onclick="zoomOut()">Zoom Out</button>
    </div>

    <script>
        let scale = 1;

        function showImage(imageSrc) {
            const img = document.getElementById("season-image");
            const zoomControls = document.querySelector(".zoom-buttons");

            // Reset scale and transformation
            scale = 1;
            img.style.transform = `scale(${scale})`;

            // Prepare to load new image
            img.style.opacity = "0";
            img.onload = function() {
                img.style.opacity = "1";
                zoomControls.style.display = "block";
            };
            img.onerror = function() {
                console.error("Failed to load image:", imageSrc);
                alert("Failed to load image. Please try again.");
            };

            // Set image source
            img.src = "/fyp/uploads/" + imageSrc;
            img.style.display = "block";
        }

        function zoomIn() {
            scale += 0.2;
            document.getElementById("season-image").style.transform = `scale(${scale})`;
        }

        function zoomOut() {
            if (scale > 0.4) {
                scale -= 0.2;
                document.getElementById("season-image").style.transform = `scale(${scale})`;
            }
        }
    </script>

</body>
</html>

    



 

    