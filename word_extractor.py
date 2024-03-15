import spacy

def extract_keywords(sentences, target_word):
    nlp = spacy.load("en_core_web_lg")
    matching_sentences = []

    for sentence_name, sentence in sentences:
        doc = nlp(sentence)
        keywords = []
        for token in doc:
            if token.pos_ in ["NOUN", "PROPN", "VERB"] and not token.is_stop:
                keywords.append(token.text)
        if target_word in keywords:
            matching_sentences.append(sentence_name)
    
    return matching_sentences

# Example usage:
nested_sentences = [
    ["Sentence 1","Python is better than C++"],
    ["Sentence 2","Java is another programming language other than Python"]
]

target_word = "Python"
matching_sentences = extract_keywords(nested_sentences, target_word)

if matching_sentences:
    print(f"The target word '{target_word}' exists in the following sentences:")
    for sentence in matching_sentences:
        print(sentence)
else:
    print(f"The target word '{target_word}' does not exist in any sentence.")
