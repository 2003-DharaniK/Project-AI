const nodemailer = require('nodemailer');

// Create a transporter
let transporter = nodemailer.createTransport({
    service: 'gmail', // Use your email service (e.g., Gmail)
    auth: {
        user: 'anish.s1910@gmail.com', // Your email
        pass: '(1910_anishS)', // Your email password or app password
    },
});

// Set up email data
let mailOptions = {
    from: 'trioinnovators@gmail.com', // Sender address
    to: 'csedharani625@gmail.com', // List of recipients
    subject: 'Hello from Nodemailer', // Subject line
    text: 'This is a test email sent using Nodemailer!', // Plain text body
};

// Send mail
transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
        return console.log('Error: ', error);
    }
    console.log('Email sent: ' + info.response);
});
