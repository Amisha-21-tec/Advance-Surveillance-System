import cv2
from detection import AccidentDetectionModel
import numpy as np
import os
from datetime import datetime

# Create a directory to save accident images and video clips if they don't exist
if not os.path.exists("accident_images"):
    os.makedirs("accident_images")
if not os.path.exists("accident_clips"):
    os.makedirs("accident_clips")

# Function to save accident images
def save_accident_image(frame):
    timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
    filename = f"accident_images/accident_{timestamp}.jpg"
    cv2.imwrite(filename, frame)
    print(f"Accident image saved: {filename}")

# Function to save accident video clips
def save_accident_clip(video_writer, frames):
    for frame in frames:
        video_writer.write(frame)
    video_writer.release()

# Function to draw rectangles and text on the frame
def draw_rectangle(frame, pred, prob, is_accident):
    height, width, _ = frame.shape
    if is_accident:
        # Draw a red rectangle around the detected accident area
        start_x, start_y = 50, 50  # Example coordinates, adjust as needed
        end_x, end_y = width - 50, height - 50
        cv2.rectangle(frame, (start_x, start_y), (end_x, end_y), (0, 0, 255), 2)  # Red color in BGR

    # Draw the probability and prediction text
    cv2.rectangle(frame, (0, 0), (280, 40), (0, 0, 0), -1)
    cv2.putText(frame, f"{pred} {prob}%", (20, 30), font, 1, (255, 255, 0), 2)

# Initialize model and font
model = AccidentDetectionModel(r"C:\xampp\htdocs\Final Project Code\Acc, Final Done\model.json", r"C:\xampp\htdocs\Final Project Code\Acc, Final Done\model_weights.weights.h5")

font = cv2.FONT_HERSHEY_SIMPLEX

# Constants
CLIP_DURATION_SEC = 5  # Duration of video clip in seconds
FPS = 30  # Frames per second

def start_application():
    video_path = "C:/Acc, Final Done/Demo.gif"
    # Uncomment the appropriate line for video input source
    video = cv2.VideoCapture(video_path)  # Replace with your actual file path
    # video = cv2.VideoCapture(0)  # For webcam input

    frame_width = int(video.get(3))
    frame_height = int(video.get(4))
    
    # Define the clip_frame_count to determine how many frames to record
    clip_frame_count = CLIP_DURATION_SEC * FPS  # Number of frames to record for the clip

    recording = False
    clip_frames = []  # To store frames for video clip
    video_writer = None

    while True:
        ret, frame = video.read()
        if not ret:
            print("Failed to grab frame")
            break

        # Convert the frame to RGB for the model
        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        roi = cv2.resize(gray_frame, (250, 250))

        # Get prediction and probability
        pred, prob = model.predict_accident(roi[np.newaxis, :, :])
        prob = round(prob[0][np.argmax(prob)] * 100, 2)  # Adjust to get the correct probability

        # Debugging: Print predictions and probabilities
        print(f"Prediction: {pred}, Probability: {prob}%")

        # Initialize is_accident as False by default
        is_accident = False

        # If accident is detected and probability is above 90%, start recording
        if pred == "Accident" and prob >= 85 and not recording:
            save_accident_image(frame)  # Save accident image
            is_accident = True
            recording = True
            clip_frames = []  # Start collecting frames for the clip

            # Initialize video writer
            timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
            video_filename = f"accident_clips/accident_clip_{timestamp}.avi"
            video_writer = cv2.VideoWriter(video_filename, cv2.VideoWriter_fourcc(*'XVID'), FPS, (frame_width, frame_height))
            print(f"Recording accident clip: {video_filename}")

        # Record video frames when accident is detected
        if recording:
            clip_frames.append(frame)
            if len(clip_frames) >= clip_frame_count:  # Stop recording after collecting enough frames
                save_accident_clip(video_writer, clip_frames)
                recording = False
                print(f"Accident clip saved: {video_filename}")
        
        # Draw rectangles and text on the frame
        draw_rectangle(frame, pred, prob, is_accident)

        # Display the video with rectangles and text
        cv2.imshow('Video', frame)

        # Press 'q' to exit the application
        if cv2.waitKey(33) & 0xFF == ord('q'):
            break

    video.release()
    if video_writer:
        video_writer.release()
    cv2.destroyAllWindows()
