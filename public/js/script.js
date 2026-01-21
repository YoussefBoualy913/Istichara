
function checkbox(){
  const Avocat = document.getElementById('Avocat');
  const Huissiers = document.getElementById('Huissiers');
  const Avocatbloc = document.querySelector('.Avocat');
  const Huissiersbloc = document.querySelector('.Huissiers');

  Avocat.addEventListener('change', () => {
    if (Avocat.checked) {
      Huissiers.checked = false;
      Avocatbloc.style.display ='';
      Huissiersbloc.style.display ='none';
    }
  });

  Huissiers.addEventListener('change', () => {
    if (Huissiers.checked) {
      Avocat.checked = false;
       Huissiersbloc.style.display ='';
      Avocatbloc.style.display ='none';
    }
  });
}
checkbox();