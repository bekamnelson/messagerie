  // Fonction pour créer un élément avec toutes ses propriétés
function createElement(type, className, innerHTML = '', appendTo) {
    const element = document.createElement(type);
    if (className) element.className = className;
    if (innerHTML) element.innerHTML = innerHTML;
    if (appendTo) appendTo.appendChild(element);
    return element;
}

// Fonction pour créer une message row
function createMessageRow(object) {
    const messageRow = createElement('div', 'message-row left', '', document.body);
    const bubble = createElement('div', 'bubble', '', messageRow);

  
  
    

    // Bloc de citation
    const quoteBox = createElement('div', 'quote-box', '', bubble);
    const quoteContent = createElement('div', 'quote-content', '', quoteBox);
    createElement('span', 'quote-name', object.tag_username, quoteContent);
    createElement('p', '',object.tag_message, quoteContent);
    createElement('div', 'quote-image', '', quoteBox); // Peut être remplacé par une image

    // Contenu du message
    const messageContent = createElement('div', 'message-content', object.message, bubble);
    createElement('span', 'timestamp',  object.timesend.substring(12, 16), messageContent);

    // Menu
    const menu = createElement('div', 'menu', '', bubble);
    createElement('div', 'menu-item', 'Répondre', menu);
    createElement('div', 'menu-item', 'Transférer', menu);
    createElement('div', 'menu-item', 'Supprimer', menu);
}

