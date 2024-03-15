import spacy

def extract_keywords(sentences):
    nlp = spacy.load("en_core_web_lg")
    keyword_dict = {}
    
    for idx, sentence in enumerate(sentences):
        doc = nlp(sentence)
        keywords = []
        for token in doc:
            if token.pos_ in ["NOUN", "PROPN", "VERB"] and not token.is_stop:
                keywords.append(token.text)
        keyword_dict[idx] = keywords
    
    return keyword_dict

def match_keyword(keyword_dict, target_word):
    matching_sentences = []
    for idx, keywords in keyword_dict.items():
        if target_word in keywords:
            matching_sentences.append(idx)
    return matching_sentences

# Example usage:
sentences = ["Python is better than C++", "Java is another programming language"]
keyword_dict = extract_keywords(sentences)
target_word = "Python"
matching_sentences = match_keyword(keyword_dict, target_word)

if matching_sentences:
    print(f"The target word '{target_word}' exists in the following sentences:")
    for idx in matching_sentences:
        print(f"Sentence {idx + 1}: {sentences[idx]}")
else:
    print(f"The target word '{target_word}' does not exist in any sentence.")
