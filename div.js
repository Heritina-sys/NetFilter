var dh = document.getElementById('dh');
var di = document.getElementById('di');
var dO = document.getElementById('do');
var df = document.getElementById('df');
document.getElementById('bh').addEventListener('click',function(e){
	e.preventDefault();
	dh.style.display = 'block';
	di.style.display = 'none';
	dO.style.display = 'none';
	df.style.display = 'none';
});
document.getElementById('bi').addEventListener('click',function(e){
	e.preventDefault();
	di.style.display = 'block';
	dh.style.display = 'none';
	dO.style.display = 'none';
	df.style.display = 'none';
});
document.getElementById('bo').addEventListener('click',function(e){
	e.preventDefault();
	dO.style.display = 'block';
	di.style.display = 'none';
	dh.style.display = 'none';
	df.style.display = 'none';
});
document.getElementById('bf').addEventListener('click',function(e){
	e.preventDefault();
	df.style.display = 'block';
	di.style.display = 'none';
	dO.style.display = 'none';
	dh.style.display = 'none';
});