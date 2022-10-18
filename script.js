const addButton = document.querySelector('#tweet-new')
const tweetList = document.querySelector('.content-main')
const newTweet = document.querySelector('.new')

addButton.addEventListener('click', function () {
    const addTweet = newTweet.value.trim();
    newTweet.value = "";
    if (addTweet == "")
        return;


    const userAva = document.createElement('img');
    userAva.className = 'content-ava';
    userAva.src = 'https://cdn-icons-png.flaticon.com/512/456/456212.png';
    userAva.alt = 'avatar';

    const divAva = document.createElement('div');
    divAva.className = 'ava';
    divAva.appendChild(userAva);
    
    const topicUser = document.createElement('span');
    topicUser.className = 'topic-user';
    topicUser.append("User");

    const nickBr = document.createElement('br');

    const topicNick = document.createElement('span');
    topicNick.className = 'topic-span topic-login';
    topicNick.append("@User49491");

    const topicA = document.createElement('a');
    topicA.href = '';
    topicA.appendChild(topicUser);

    const taskTopic = document.createElement('p');
    taskTopic.className = 'topic';
    taskTopic.appendChild(topicA);
    taskTopic.appendChild(topicNick);
    taskTopic.appendChild(nickBr);
    taskTopic.appendChild(nickBr);

    const taskText = document.createElement('p');
    taskText.className = 'topic bottom-topic';
    taskText.innerHTML = addTweet;
    taskTopic.appendChild(nickBr);

    const removeTweet = document.createElement('img')
    removeTweet.className = 'content-logos more-topic';
    removeTweet.src = 'https://img.icons8.com/ios-glyphs/344/more.png';
    removeTweet.alt = 'Delete task';
    removeTweet.addEventListener('click', deleteItem);

    const shareLogo = document.createElement('img')
    shareLogo.className = 'content-logos';
    shareLogo.src = 'https://img.icons8.com/ios-glyphs/344/share-rounded.png';
    shareLogo.alt = 'logo';

    const likeLogo = document.createElement('img')
    likeLogo.className = 'content-logos like';
    likeLogo.src = 'https://cdn-icons-png.flaticon.com/512/8182/8182897.png';
    likeLogo.alt = 'logo';

    const repLogo = document.createElement('img')
    repLogo.className = 'content-logos repost';
    repLogo.src = 'https://img.icons8.com/material-outlined/344/retweet.png';
    repLogo.alt = 'logo';

    const commLogo = document.createElement('img')
    commLogo.className = 'content-logos';
    commLogo.src = 'https://img.icons8.com/ios/344/speech-bubble--v1.png';
    commLogo.alt = 'logo';

    const logos = document.createElement('div')
    logos.className = 'logos';
    logos.appendChild(commLogo);
    logos.appendChild(repLogo);
    logos.appendChild(likeLogo);
    logos.appendChild(shareLogo);

    const item = document.createElement('div');
    item.className = 'content';
    item.appendChild(divAva);
    item.appendChild(taskTopic);
    item.appendChild(removeTweet);
    item.appendChild(taskText);
    item.appendChild(logos);


    tweetList.appendChild(item);
});

function deleteItem() {
    this.parentNode.remove();
}
