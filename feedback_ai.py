import spacy

# Load English tokenizer, tagger, parser, NER, and word vectors
nlp = spacy.load("en_core_web_sm")

def analyze_feedback(feedback_list):
    feedback_priorities = []
    for feedback in feedback_list:
        doc = nlp(feedback)
        # Example criteria for determining priority
        priority_score = 0
        for token in doc:
            if token.pos_ in ["NOUN", "ADJ"]:  # Example: prioritize nouns and adjectives
                priority_score += 1
            elif token.dep_ == "ROOT":  # Example: prioritize sentences with clear main verbs
                priority_score += 1
        feedback_priorities.append((feedback, priority_score))
    # Sort feedback by priority score in descending order
    sorted_feedback = sorted(feedback_priorities, key=lambda x: x[1])
    return sorted_feedback

# Example feedback list
feedback_list = [
    "The user interface is user-friendly and intuitive.",
    "The app crashes frequently when performing certain actions.",
    "I love the new feature updates. Keep up the good work!",
    "There are too many ads in the free version of the app.",
    "The customer support team was very helpful and responsive."
]

# Analyze feedback and sort by priority
sorted_feedback = analyze_feedback(feedback_list)

# Print sorted feedback
for idx, (feedback, priority_score) in enumerate(sorted_feedback, start=1):
    print(f"{idx}. Priority Score: {priority_score} - Feedback: {feedback}")
