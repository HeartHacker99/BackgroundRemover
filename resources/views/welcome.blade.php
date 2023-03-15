<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>

<h1>Make Transparent Background</h1>

<!-- Images -->

<div style="display: flex; justify-content: space-between;padding: 30px;">

    <div>
        <label for="original-background">Orignal Background</label>
        <input type="radio" name="background" id="original-background" onchange="handleChange(this);"
               value="orignal">

        <br>

        <label for="transparent-background">Transparent Background</label>
        <input type="radio" name="background" id="transparent-background" onchange="handleChange(this);"
               value="transparent">
    </div>

    <div>
        <img id="car-image" style="border: 4px solid black;"
             src="https://s3.us-west-2.amazonaws.com/sitescube-docs/910/car/forsale/images/2023/02/pic-69e4623cffd6c91f23244c98f648deb5.jpg"
             alt="A cute cat" width="60%">
    </div>


</div>


<script>
    let oldImage = $('#car-image').attr('src');
    let oldImageSaved = $('#car-image').attr('src');
    let newImage;


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function handleChange(src) {
        if (src.value == 'orignal') {
            setImage(oldImageSaved)
        } else {
            if (newImage) {
                setImage(newImage)
            } else {
                alert("My Love❤️‍🔥 Please be Patient⏰...");
                console.log('My Love❤️‍🔥 Please be Patient⏰...');
                // create a new FormData object
                var formData = new FormData();

                // append the image files to the FormData object
                formData.append('oldImage', oldImage);

                $.ajax({
                    type: 'POST',
                    url: "http://127.0.0.1:8000/api/result",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        newImage = data;
                        setImage(newImage);
                        alert("Thank's for your patience My Love❤️‍🔥; That's means alote💘💘💘");
                        console.log("Thank's for your patience My Love❤️‍🔥; That's means alote💘💘💘");
                    }
                });
            }
        }

    }

    function setImage(imagePath)
    {
        $('#car-image').attr("src", imagePath);
    }

</script>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


