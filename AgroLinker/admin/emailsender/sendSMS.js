const twilio = require('twilio');

// Your Twilio credentials
const accountSid = ''; // Replace with actual Account SID
const authToken = ''; // Replace with your Auth Token
const client = new twilio(accountSid, authToken);

// Function to send SMS
const sendSMS = (worker) => {
    // Message body with the applicant's details dynamically inserted
    const smsMessage = `Hello ${worker.full_name},

    We are excited to inform you that you have been selected for the ${worker.position} role at AgroLinker. 
    Please confirm your acceptance by replying to this message or contact us on the website for further details.

    Best regards,
    Dharani,
    AgroLinker`;

    // Format the phone number
    const formattedPhoneNumber = `+91${worker.phone_no}`; // Concatenate country code with phone number

    // Twilio API call to send the SMS
    client.messages.create({
        body: smsMessage,               // SMS content
        from: '',           // Replace with your Twilio number
        to: formattedPhoneNumber         // Recipient's phone number
    })
    .then(message => console.log(`Message sent: ${message.sid}`))
    .catch(error => console.error('Error sending message:', error));
};



// Call the function to send an SMS with the worker's details
sendSMS(worker);



