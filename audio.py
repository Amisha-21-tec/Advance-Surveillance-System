from gtts import gTTS

# Text to convert to speech
text = "Attention: An emergency has been detected. Immediate action is required to ensure safety."
language = "en"

# Generate and save the audio
tts = gTTS(text=text, lang=language, slow=False)
tts.save("Emergency_Audio.mp3")
print("Audio saved as Emergency_Audio.mp3")
