document.addEventListener('DOMContentLoaded', function() {
    var communityButton = document.getElementById('communityButton');
    var imagePaths = [
        { path: "1STSLIDE.png", description: "Description for the first image 1" },
        { path: "2NDSLIDE.png", description: "Description for the second image 2" },
        { path: "3RDSLIDE.png", description: "Description for the third image 3" }
    ];

    communityButton.addEventListener('click', function(event) {
        event.preventDefault();
        showBulletinBoard(imagePaths);
    });

    function showBulletinBoard(imagePaths) {
        var existingBulletinBoard = document.getElementById('bulletinBoard');
        if (existingBulletinBoard) {
            existingBulletinBoard.remove();
        }

        // Create a new bulletin board
        var bulletinBoardSection = document.createElement('div');
        bulletinBoardSection.id = 'bulletinBoard';
        bulletinBoardSection.innerHTML = '<h2>Bulletin Board</h2>'; // Add the title
        var bulletinImagesContainer = document.createElement('div');
        bulletinImagesContainer.classList.add('bulletin-images');

        imagePaths.forEach(function(image, index) {
            var imageElement = document.createElement('img');
            imageElement.src = image.path;
            imageElement.alt = 'Bulletin Image ' + (index + 1);
            imageElement.classList.add('bulletin-image');
            imageElement.onclick = function() { enlargeImage(image.path, image.description); };
            bulletinImagesContainer.appendChild(imageElement);
        });

        bulletinBoardSection.appendChild(bulletinImagesContainer);
        document.getElementById('communitySection').appendChild(bulletinBoardSection);
    }

    function enlargeImage(imageSrc, description) {
        var enlargedImageContainer = document.getElementById('enlargedImageContainer');
        if (!enlargedImageContainer) {
            enlargedImageContainer = document.createElement('div');
            enlargedImageContainer.id = 'enlargedImageContainer';
            document.getElementById('communitySection').prepend(enlargedImageContainer);
        }
        enlargedImageContainer.innerHTML = '';
    
        var enlargedImage = document.createElement('img');
        enlargedImage.src = imageSrc;
        enlargedImage.classList.add('enlarged-image');
    
        var imageDescription = document.createElement('p');
        imageDescription.textContent = description;
    
        enlargedImageContainer.appendChild(enlargedImage);
        enlargedImageContainer.appendChild(imageDescription);
    }
});

// calendar 

function change_text() {
    var element = document.getElementById("date-events");
    element.textContent = "Text changed!";
}


//POP UP

document.querySelector("#close").addEventListener("click", function() {
    document.querySelector(".pop-up-container").style.display ="none";
});
document.querySelector("#close").addEventListener("click", function() {
    document.querySelector(".modal").style.display ="none";
});

//LOGOUT

// Get the modal
var modal = document.getElementById("myModal");

// Get the link that opens the modal
var link = document.getElementById("openModalLink");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the link, open the modal
link.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
function toggleDisplayList(add_id) {
  $.ajax({
      url: 'fetch_alumni_data_list.php',
      type: 'GET',
      data: { add_id: add_id },
      dataType: 'json',
      success: function(response) {
          if (response.error) {
              console.error(response.error);
              return;
          }
          $('#alumniDetails').html(`
              
              <img src="${response.profile_picture}" class="hidden-profile-img" alt="Profile Picture">
              <div class="hidden-profile-info">
                  <p><b>Name:</b> ${response.firstname} ${response.middlename} ${response.lastname}</p>
                  <p><b>Age:</b> ${response.age}</p>
                  <p><b>Course:</b> ${response.course}</p>
                  <p><b>Address:</b> ${response.address}</p>
                  <p><b>Email:</b> ${response.email}</p>
                  <p><b>Facebook:</b> ${response.facebooklink}</p>
                  <p><b>Description:</b> ${response.description}</p>
              </div>
            
          `);
          // Show the hidden div
          $('#hiddenDiv').show();
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });
}
//invisible div
function toggleDisplay(add_id) {
  $.ajax({
      url: 'fetch_alumni_data.php',
      type: 'GET',
      data: { add_id: add_id },
      dataType: 'json',
      success: function(response) {
          if (response.error) {
              console.error(response.error);
              return;
          }
          $('#alumniDetails').html(`
              
              <img src="${response.profile_picture}" class="hidden-profile-img" alt="Profile Picture">
              <div class="hidden-profile-info">
                  <p><b>Name:</b> ${response.firstname} ${response.middlename} ${response.lastname}</p>
                  <p><b>Age:</b> ${response.age}</p>
                  <p><b>Course:</b> ${response.course}</p>
                  <p><b>Address:</b> ${response.address}</p>
                  <p><b>Email:</b> ${response.email}</p>
                  <p><b>Facebook:</b> ${response.facebooklink}</p>
                  <p><b>Description:</b> ${response.description}</p>
              </div>
              <button id="approveButton" data-addid="${add_id}">Approve</button>
              <button id="rejectButton" data-addid="${add_id}">Reject</button>
          `);
          // Show the hidden div
          $('#hiddenDiv').show();
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });

  // Event handler for the "Approve" button
  $(document).on('click', '#approveButton', function() {
      var add_id = $(this).data('addid');
      $.ajax({
          url: 'transfer_data.php', // PHP script to handle data transfer
          type: 'POST',
          data: { add_id: add_id },
          dataType: 'json',
          success: function(response) {
              // Handle success response if needed
              if (response.success) {
                alert("Alumni Approved"); window.location.href = "approval.php";
              }
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  });
    // Event handler for the "Reject" button
    $(document).on('click', '#rejectButton', function() {
      var add_id = $(this).data('addid');
      $.ajax({
          url: 'reject_data.php', // PHP script to handle rejection
          type: 'POST',
          data: { add_id: add_id },
          dataType: 'json',
          success: function(response) {
              // Handle success response if needed
              alert("Alumni Rejected!"); window.location.href = "approval.php";
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  });
}

function toggleDisplayArchive(add_id) {
  $.ajax({
      url: 'fetch_alumni_data_archive.php',
      type: 'GET',
      data: { add_id: add_id },
      dataType: 'json',
      success: function(response) {
          if (response.error) {
              console.error(response.error);
              return;
          }
          $('#alumniDetails').html(`
              
              <img src="${response.profile_picture}" class="hidden-profile-img" alt="Profile Picture">
              <div class="hidden-profile-info">
                  <p><b>Name:</b> ${response.firstname} ${response.middlename} ${response.lastname}</p>
                  <p><b>Age:</b> ${response.age}</p>
                  <p><b>Course:</b> ${response.course}</p>
                  <p><b>Address:</b> ${response.address}</p>
                  <p><b>Email:</b> ${response.email}</p>
                  <p><b>Facebook:</b> ${response.facebooklink}</p>
                  <p><b>Description:</b> ${response.description}</p>
              </div>
              <button id="approveButton" data-addid="${add_id}">Re-Approve</button>
              <button id="rejectButton" data-addid="${add_id}">Delete</button>
          `);
          // Show the hidden div
          $('#hiddenDiv').show();
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });

  // Event handler for the "Approve" button
  $(document).on('click', '#approveButton', function() {
      var add_id = $(this).data('addid');
      $.ajax({
          url: 'transfer_data_archive.php', // PHP script to handle data transfer
          type: 'POST',
          data: { add_id: add_id },
          dataType: 'json',
          success: function(response) {
              // Handle success response if needed
              if (response.success) {
                  // Reload the page after successful deletion
                  alert("Alumni Approved!"); window.location.href = "archive.php";
              }
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  });
    // Event handler for the "Reject" button
    $(document).on('click', '#rejectButton', function() {
      var add_id = $(this).data('addid');
      $.ajax({
          url: 'delete_data_archive.php', // PHP script to handle data transfer
          type: 'POST',
          data: { add_id: add_id },
          dataType: 'json',
          success: function(response) {
              // Handle success response if needed
              if (response.success) {
                  // Reload the page after successful deletion
                  alert("Alumni Deleted!"); window.location.href = "archive.php";
              }
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  });
    
}

//search button 
function searchAlumni() {
  // Get the search query
  var searchQuery = document.getElementById('searchInput').value.trim();
  
  // Send AJAX request to search.php with the searchQuery
  $.ajax({
      type: 'POST',
      url: 'search.php', // Create a separate PHP file for handling search
      data: {query: searchQuery},
      success: function(response) {
          // Display the search results in the appropriate container
          $('.scrollable1').html(response); // Assuming your search results will replace the alumni list
      }
  });
}


function searchAlumniApproval() {
  // Get the search query
  var searchQuery = document.getElementById('searchInput').value.trim();
  
  // Send AJAX request to search.php with the searchQuery
  $.ajax({
      type: 'POST',
      url: 'search_approval.php', // Create a separate PHP file for handling search
      data: {query: searchQuery},
      success: function(response) {
          // Display the search results in the appropriate container
          $('.scrollable1').html(response); // Assuming your search results will replace the alumni list
      }
  });
}

function searchAlumniList() {
  // Get the search query
  var searchQuery = document.getElementById('searchInput').value.trim();
  
  // Send AJAX request to search.php with the searchQuery
  $.ajax({
      type: 'POST',
      url: 'search_list.php', // Create a separate PHP file for handling search
      data: {query: searchQuery},
      success: function(response) {
          // Display the search results in the appropriate container
          $('.scrollable1').html(response); // Assuming your search results will replace the alumni list
      }
  });
}


// like unline

function likePost(postId) {
    // Send AJAX request to like.php with postId
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "like.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Update like count in the UI if successful
                document.querySelector('#post_' + postId + ' .like-count').textContent = xhr.responseText;
            } else {
                // Handle error if any
                console.error("Error: " + xhr.status);
            }
        }
    };
    xhr.send("postId=" + postId);
}

function unlikePost(postId) {
    // Send AJAX request to unlike.php with postId
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "unlike.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Update like count in the UI if successful
                document.querySelector('#post_' + postId + ' .like-count').textContent = xhr.responseText;
            } else {
                // Handle error if any
                console.error("Error: " + xhr.status);
            }
        }
    };
    xhr.send("postId=" + postId);
}


//FORM
