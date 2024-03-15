import sys
import json
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

if __name__ == "__main__":
    # Extract input from command-line arguments
    input_data = json.loads(sys.argv[1])

    # Extract nested sentences
    nested_sentences = [(item[0], item[1]) for item in input_data]

    # Specify the target word
    target_word = "Python"

    # Extract matching sentences
    matching_sentences = extract_keywords(nested_sentences, target_word)

    # Output the result
    if matching_sentences:
        print(f"The target word '{target_word}' exists in the following sentences:")
        for sentence in matching_sentences:
            print(sentence)
    else:
        print(f"The target word '{target_word}' does not exist in any sentence.")
