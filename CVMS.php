<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Vaccination Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Roboto', sans-serif; background-color: #eef2f5; color: #333; line-height: 1.6; }

        .container {
            width: 100%; /* Set to 100% to occupy full width */
            margin: 0; /* No margin */
            padding: 0; /* No padding */
            background: #fff; 
            border-radius: 15px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        header { 
            text-align: center; 
            margin-bottom: 30px; 
            padding: 20px; 
            background: linear-gradient(135deg, #007bff, #0056b3); 
            color: #fff; 
            border-radius: 15px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 { 
            font-size: 2.5em; 
            margin: 0; 
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .image-section { 
            text-align: center; 
            margin: 20px 0; 
            position: relative; 
        }

        .laptop-image {
            width: 100%; 
            max-width: 100%; 
            height: auto; 
            border-radius: 15px; 
            border: 8px solid #007bff; 
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4); 
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative; 
            background: #fff; 
            padding: 15px; 
        }

        .keyboard-image {
            position: absolute; 
            top: 70%; 
            left: 50%;
            transform: translateX(-50%) scale(0.95); 
            width: 80%; /* Reduced width for better layering */
            max-width: 80%; 
            z-index: -1; 
            border-radius: 10px; 
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4); 
            transition: transform 0.3s;
        }

        .keyboard-image:hover {
            transform: translateX(-50%) scale(1); 
        }

        .modules-description, .how-to-use {
            margin-top: 20px; 
            padding: 20px; 
            background: #f9f9f9;
            border-radius: 10px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
        }

        h2 {
            margin-bottom: 15px; 
            color: #007bff; 
            text-align: center;
            font-size: 2em; 
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
        }

        ol { 
            list-style-type: decimal; 
            padding: 0; 
            padding-left: 25px; 
            margin-top: 10px; 
        }

        ol li { 
            padding: 10px 0; 
            font-size: 16px; 
            position: relative; 
            color: #555; 
        }

        ul {
            margin-top: 10px; 
            padding-left: 20px; 
            list-style-type: disc; 
        }

        ul li {
            font-size: 15px; 
            color: #666; 
        }

        .button-container {
            text-align: center; 
            margin: 20px 0;
        }

        .button {
            background-color: #007bff; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            padding: 12px 20px; 
            font-size: 16px; 
            margin: 0 10px; 
            cursor: pointer; 
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .button:hover {
            background-color: #0056b3; 
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); 
        }

        .request {
            margin: 10px 0; 
            padding: 10px; 
            border: 1px solid #007bff; 
            border-radius: 5px; 
            background: #ffffff;
            transition: box-shadow 0.3s; 
        }

        .request:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin: 10px 0;
        }

        .card-header {
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 8px; /* Space between icon and text */
            color: #007bff;
        }

        @media (max-width: 768px) {
            .container { padding: 20px; }
            h1 { font-size: 1.8em; } 
            h2 { font-size: 1.5em; }
            .laptop-image, .keyboard-image { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Child Vaccination Management System</h1>
        </header>

        <!-- Laptop Image Section -->
        <div class="image-section">
            <img src="assets/images/CVMS.png" alt="Laptop Vaccination Management System" class="laptop-image"> <!-- Update with your laptop image path -->
            <img src="assets/images/keyboard.png" alt="Keyboard" class="keyboard-image"> <!-- Update with your keyboard image path -->
        </div>

        <!-- Button Section -->
        <div class="button-container">
            <button class="button" onclick="window.open('http://your-live-preview-url.com', '_blank')">Live Preview</button>
            <button class="button" onclick="window.open('http://your-documentation-url.com', '_blank')">Documentation</button>
        </div>

        <!-- Modules Description Section -->
        <div class="modules-description card">
            <h2>Modules Description</h2>
            <h3>Admin <i class="fas fa-user-shield"></i></h3>
            <ol>
                <li>All Child Details
                    <ul>
                        <li>View all child profile details.</li>
                    </ul>
                </li>
                <li>Date of Vaccination
                    <ul>
                        <li>Upcoming date of vaccination of all children.</li>
                    </ul>
                </li>
                <li>Report of Vaccination
                    <ul>
                        <li>Child vaccination (date-wise report).</li>
                    </ul>
                </li>
                <li>List of Vaccine
                    <ul>
                        <li>Available or unavailable.</li>
                        <li>Admin can view the availability of vaccinations.</li>
                    </ul>
                </li>
                <li>Request from Parents
                    <ul>
                        <li>Approve or reject.</li>
                        <li>Once the request for an appointment from the parent side, it will be approved from the admin.</li>
                    </ul>
                </li>
                <li>Add Hospital
                    <ul>
                        <li>Admin can add the hospital details.</li>
                    </ul>
                </li>
                <li>Update/Delete Hospital
                    <ul>
                        <li>Admin can update or delete the hospital details.</li>
                    </ul>
                </li>
                <li>List of Hospitals
                    <ul>
                        <li>Admin can view the hospital details.</li>
                    </ul>
                </li>
                <li>Booking Details
                    <ul>
                        <li>Admin can view the booking details from the parent side for booking vaccinations.</li>
                    </ul>
                </li>
            </ol>

            <h3>Parent <i class="fas fa-user-friends"></i></h3>
            <ol>
                <li>Details of Child
                    <ul>
                        <li>Update and maintain the child's vaccination details.</li>
                    </ul>
                </li>
                <li>Vaccination Dates
                    <ul>
                        <li>Can get notified through the dashboard of their respective accounts about upcoming vaccinations.</li>
                    </ul>
                </li>
                <li>Book Hospital
                    <ul>
                        <li>User can search the list of hospitals and book a schedule for vaccine dates.</li>
                    </ul>
                </li>
                <li>Report of Vaccination Taken
                    <ul>
                        <li>Can get the report status of previous vaccinations of their respective infants.</li>
                    </ul>
                </li>
            </ol>

            <h3>Hospital <i class="fas fa-hospital-alt"></i></h3>
            <ol>
                <li>Register & Login
                    <ul>
                        <li>Can register and log in into the app with hospital name, address, and location details.</li>
                    </ul>
                </li>
                <li>Update Vaccine Status
                    <ul>
                        <li>Hospital will receive the appointment once it's booked from the admin side. If vaccination is completed, they will update the status to "Vaccinated" or "Not Vaccinated".</li>
                    </ul>
                </li>
            </ol>
        </div>

    </div>
</body>
</html>
