import smtplib
import os
from email.message import EmailMessage
import ssl
import random


email_sender= 'studies276@gmail.com'
email_password='rjtwaznscdcghxol'
number = random.randint(100000, 999999)
code = str(number)
email_receiver=input("enter the receiver's email id=>>")
subject='Verification from ProGro'
body = "Dear User,\n\nYour verification code is:"+code+" \n\nPlease use this code to verify your email address.\n\nThank you,\nprogo Team"

print(body)
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
