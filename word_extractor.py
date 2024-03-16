import spacy
import random
from spacy.training import Example

# Define thresholds for stars, lines of code, commits, and forks
STAR_THRESHOLD = 50
LINES_OF_CODE_THRESHOLD = 1000
COMMITS_THRESHOLD = 50
FORKS_THRESHOLD = 20

# Define categories
CATEGORIES = ["Beginner", "Intermediate", "Expert"]

# Sample sentences for training
TRAIN_DATA = [
    ("This repository has 30 stars, 800 lines of code, 20 commits, and 10 forks.", {"cats": {"Beginner": True, "Intermediate": False, "Expert": False}}),
    ("The project has 100 stars, 3000 lines of code, 80 commits, and 25 forks.", {"cats": {"Beginner": False, "Intermediate": True, "Expert": False}}),
    ("The repository has 200 stars, 5000 lines of code, 120 commits, and 30 forks.", {"cats": {"Beginner": False, "Intermediate": False, "Expert": True}})
]

# Train the model
def train_model(train_data, iterations=20):
    nlp = spacy.blank("en")
    textcat = nlp.add_pipe("textcat")
    for category in CATEGORIES:
        textcat.add_label(category)

    random.shuffle(train_data)
    examples = []
    for text, annots in train_data:
        examples.append(Example.from_dict(nlp.make_doc(text), annots))

    other_pipes = [pipe for pipe in nlp.pipe_names if pipe != "textcat"]
    with nlp.disable_pipes(*other_pipes):
        optimizer = nlp.begin_training()
        for i in range(iterations):
            random.shuffle(examples)
            for batch in spacy.util.minibatch(examples, size=8):
                nlp.update(batch, drop=0.2, sgd=optimizer)

    return nlp

# Test the model
# Test the model
def test_model(model, test_data):
    for text in test_data:
        doc = model(text)
        print(f"Text: {text}")
        print("Predicted category:", max(doc.cats, key=doc.cats.get))
        print()

# Test the model

test_model(nlp_model, test_data)

# Train the model
nlp_model = train_model(TRAIN_DATA)

# Test the model
test_data = [
    "This repository has 20 stars, 500 lines of code, 10 commits, and 5 forks.",
    "The project has 70 stars, 2000 lines of code, 60 commits, and 15 forks.",
    "The repository has 150 stars, 4000 lines of code, 100 commits, and 25 forks."
]
test_model(nlp_model, test_data)
