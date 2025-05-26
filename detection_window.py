from PyQt5.QtWidgets import QMainWindow
from PyQt5.uic import loadUi
from PyQt5.QtCore import QThread, Qt, pyqtSignal, pyqtSlot
from PyQt5.QtGui import QImage, QPixmap
import cv2
import numpy as np
import time
import requests
import os
from detection import Detection

# Load the UI file for the detection window
ui_file = os.path.join(os.path.dirname(__file__), 'UI/detection_window.ui')

# Manages detection window, starts and stops detection thread
class DetectionWindow(QMainWindow):
    def __init__(self):
        super(DetectionWindow, self).__init__()
        loadUi(ui_file, self)

        self.stop_detection_button.clicked.connect(self.close)

    # Create detection instance with email configuration
    def create_detection_instance(self, token, location, receiver):
        # Define email configuration
        email_config = {
            'sender_email': 'amiv4488@gmail.com',  # Replace with your email
            'sender_password': 'spng vvmj fqqm wqdc', #'vibe2024space',         # Replace with your email password
            'smtp_server': 'smtp.gmail.com',          # Replace with your SMTP server
            'smtp_port': 587                           # Use 465 for SSL, 587 for TLS
        }

        # Create the Detection instance with the email configuration
        self.detection = Detection(token, location, receiver, email_config)

    # Assigns detection output to the label in order to display detection output
    @pyqtSlot(QImage)
    def setImage(self, image):
        self.label_detection.setPixmap(QPixmap.fromImage(image))

    # Starts detection
    def start_detection(self):
        self.detection.changePixmap.connect(self.setImage)
        self.detection.start()
        self.show()

    # Handle close event to stop the detection thread
    def closeEvent(self, event):
        self.detection.running = False
        event.accept()
