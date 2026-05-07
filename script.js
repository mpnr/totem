const steps = document.querySelectorAll(".step");
const nextBtns = document.querySelectorAll(".next-btn");
const prevBtns = document.querySelectorAll(".prev-btn");
const progressBar = document.getElementById("progressBar");

let currentStep = 0;

function updateSteps(){

  steps.forEach((step, index) => {

    if(index === currentStep){
      step.classList.add("active");
    }else{
      step.classList.remove("active");
    }

  });

  const totalSteps = steps.length - 1;
  const progress = (currentStep / totalSteps) * 100;

  progressBar.style.width = progress + "%";
}

nextBtns.forEach(button => {

  button.addEventListener("click", () => {

    if(currentStep < steps.length - 1){
      currentStep++;
      updateSteps();
    }

  });

});

prevBtns.forEach(button => {

  button.addEventListener("click", () => {

    if(currentStep > 0){
      currentStep--;
      updateSteps();
    }

  });

});

document.getElementById("surveyForm").addEventListener("submit", (e) => {

  e.preventDefault();

  currentStep++;

  updateSteps();

});

updateSteps();