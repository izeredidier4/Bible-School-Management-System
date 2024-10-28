<!DOCTYPE html>
<html>
<head>
    <style>
        /* Your existing CSS styles... */

        /* Additional styles for icons and layout */
        .report-container {
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px; /* Adjust the width as needed */
            margin: 0 auto; /* Center the container horizontally */
        }

        .logo img {
            width: 150px;
            height: 120px;
            border-radius: 5px;
        }

        /* Styles for Font Awesome icons */
        .icon {
            margin-right: 5px;
            color: #3498db;
        }

        /* Styles for report title */
        .report-title {
            color: #3498db;
            font-size: 26px;
            text-decoration: underline;
            display: flex;
            justify-content: center;
            margin-left: 20px;
        }

        .report {
            margin: 20px auto;
            font-size: 30px;
            align-content: center;
        }
        .logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; /* Optional: Adjust margin as needed */
}
        /* Styles for the teacher's remarks based on grade */
        .remarks {
            font-weight: bold;
        }

        .remarks.above-70 {
            color: green;
        }

        .remarks.below-70 {
            color: red;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="logo">
            <!-- Display the image here if you want to include it in the report -->
            @foreach($images as $image)
            <img src="data:image/png;base64,{{ base64_encode($image->image_data) }}" alt="logo">
            @endforeach
        </div>
        <br>
        <h3 class="report" style="text-align: center;"> Children Sabbath School Management System</h3>
        <br>
        <h3 class="report-title"><strong>Child Report </strong></h3>
        <br>
        <div class="report-details">
            <p><strong><i class="icon fas fa-user"></i> Child Name:</strong> {{ $gradeData['child_name'] }}</p>
            <p><strong><i class="icon fas fa-birthday-cake"></i> Age:</strong> {{ $gradeData['age'] }}</p>
            <p><strong><i class="icon fas fa-school"></i> Class:</strong> {{ $gradeData['class_name'] }}</p>
            <p><strong><i class="icon fas fa-chalkboard"></i> Course Title:</strong> {{ $gradeData['quiz_title'] }}</p>
            <p><strong><i class="icon fas fa-star"></i> Grade:</strong> {{ $gradeData['grade'] }}</p>
            <p><strong><i class="icon fas fa-comment"></i> Teacher's Remarks:</strong>
                <span class="remarks {{ $gradeData['grade'] > 70 ? 'above-70' : 'below-70' }}">
                    {{ $gradeData['teachers_remarks'] }}
                </span>
            </p>
            
            <!-- Add other report-related details here -->
        </div>
    </div>
</body>
</html>
<br>