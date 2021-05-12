'use strict';

function onDeletePost(event)
{
    event.preventDefault();
    
    if (confirm('Voulez-vous vraiment supprimer ce post ?')) {
        location.assign(this.getAttribute('href'));
    }
}

let deleteLinks = document.querySelectorAll('.delete-post');

// for (let link of deleteLinks) {
//     link.addEventListener('click', onDeletePost);
// }

for (let i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener('click', onDeletePost);
}