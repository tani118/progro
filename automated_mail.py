import smtplib
import random
import os
from email.message import EmailMessage
import ssl
otp = random.randint(10000, 99999)


email_sender= 'studies276@gmail.com'
email_password='rjtwaznscdcghxol'
email_receiver=input("enter the receiver's email id=>>")

subject='Verification from ProGro'
body = f"Dear User,\n\nYour verification code is: {otp}\n\nPlease use this code to verify your email address.\n\nThank you,\nYourAppName Team"


em= EmailMessage()
em['From']=email_sender
em['To']=email_receiver
em['Subject']=subject
em.set_content(body) 

context=ssl.create_default_context()

with smtplib.SMTP_SSL('smtp.gmail.com',465, context=context) as smtp:
    smtp.login(email_sender, email_password)
    smtp.sendmail(email_sender,email_receiver, em.as_string())

print("###email sent successfully###")
