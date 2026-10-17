document.getElementById('p').addEventListener('change', function() {
    var div = document.getElementById('sport');
    var div1 = document.getElementById('dport');
    if (this.value === '1' || this.value === '') {
      div.style.display = 'none';
      div1.style.display = 'none';
    } else {
      div.style.display = 'inline-block'; 
      div1.style.display = 'inline-block';
    }
  });
