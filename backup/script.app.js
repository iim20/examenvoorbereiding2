
const addQuestionBtn = document.querySelector('#add-question');
const questionsDiv = document.querySelector('#questions');

let questionCount = 1;

addQuestionBtn.addEventListener('click', () => {
    questionCount++;

    const newQuestionDiv = document.createElement('div');
    newQuestionDiv.classList.add('question');

    const questionLabel = document.createElement('label');
    questionLabel.innerText = `Question ${questionCount}:`;

    const questionInput = document.createElement('input');
    questionInput.type = 'text';
    questionInput.name = 'questions[]';
    questionInput.required = true;

    const answersDiv = document.createElement('div');
    answersDiv.classList.add('answers');

    const answersLabel = document.createElement('label');
    answersLabel.innerText = 'Answers:';

    const answerInput1 = document.createElement('input');
    answerInput1.type = 'text';
    answerInput1.name = `answers[${questionCount}][]`;
    answerInput1.required = true;

    const answerInput2 = document.createElement('input');
    answerInput2.type = 'text';
    answerInput2.name = `answers[${questionCount}][]`;
    answerInput2.required = true;

    answersDiv.appendChild(answersLabel);
    answersDiv.appendChild(answerInput1);
    answersDiv.appendChild(answerInput2);

    newQuestionDiv.appendChild(questionLabel);
    newQuestionDiv.appendChild(questionInput);
    newQuestionDiv.appendChild(answersDiv);

    questionsDiv.appendChild(newQuestionDiv);
});