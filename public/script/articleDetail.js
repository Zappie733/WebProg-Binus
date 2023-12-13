function toggleHeart(icon) {
  icon.classList.toggle('heart-red'); 
  if (icon.classList.contains('heart-red')) {
    icon.classList.remove('default');
  } else {
    icon.classList.add('default');
  }
}