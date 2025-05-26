from flask import Flask, jsonify
import requests

app = Flask(__name__)

# Google Custom Search API details
API_KEY = "AIzaSyAcJq_lHnSZBgAwo4vdbfUPlUH8t7Q9oTE"
SEARCH_ENGINE_ID = "45733364a5c8a4a47"
SEARCH_QUERY = "accidents in India"

@app.route('/news', methods=['GET'])
def get_news():
    url = f"https://www.googleapis.com/customsearch/v1?q={SEARCH_QUERY}&cx={SEARCH_ENGINE_ID}&key={API_KEY}"
    response = requests.get(url)
    data = response.json()
    
    articles = []
    if "items" in data:
        for item in data["items"]:
            articles.append({
                "title": item.get("title"),
                "link": item.get("link"),
                "snippet": item.get("snippet")
            })

    return jsonify({"news": articles})

if __name__ == '__main__':
    app.run(debug=True)
