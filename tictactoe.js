  

  function openLevelPopup() {
    document.getElementById("levelPopupOverlay").style.display = "flex";
}

function closeLevelPopup() {
    document.getElementById("levelPopupOverlay").style.display = "none";
}

function openPopup() {
    document.getElementById("popupOverlay").style.display = "flex";
}

function closePopup() {
    document.getElementById("popupOverlay").style.display = "none";
}

function openLogin() {
    
    closePopup();
}

function openSignup() {
    
    closePopup();
}
function startGame(mode, level) {
    if (mode === 'computer') {
        if (level === 'easy') {
            window.location.href = 'computer_play_easy.html';
        } else if (level === 'hard') {
            window.location.href = 'computer_play_hard.html';
        }
    } else if (mode === 'pass') {
        
        window.location.href = 'pass_and_play.html';
    } else if (mode === 'online') {
        
        window.location.href = 'online_play.html';
    }
}