const express = require('express');
const twilio = require('twilio');
const bodyParser = require('body-parser');
const cors = require('cors'); // Import cors

// Create the Express app
const app = express();

// Define the port number
const port = 3000;

// Twilio credentials
const accountSid = ''; // Replace with your actual Account SID
const authToken = ''; // Replace with your actual Auth Token
const client = new twilio(accountSid, authToken);

// Use CORS and Body Parser
app.use(cors()); // Enable CORS
app.use(bodyParser.json()); // Enable JSON body parsing

app.post('/sendSMS', (req, res) => {
    const { phoneNumber, smsMessage } = req.body; // This line extracts phoneNumber correctly

    client.messages.create({
        body: smsMessage,
        from: '', // Replace with your Twilio number
        to: phoneNumber // This will be the formatted phone number including the country code
    })
    .then(message => {
        console.log(`Message sent: ${message.sid}`);
        res.status(200).send('SMS sent successfully');
    })
    .catch(error => {
        console.error('Error sending message:', error);
        res.status(500).send('Failed to send SMS');
    });
});


app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
