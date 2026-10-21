const tasksContainer = document.getElementById('tasks_container');
const projectSelect = document.querySelector(".projects");


// **************************************************************************************//
// SRORTABLE ENABLE AND DRAG & DROP CODE ************************************************//

// ............Helper function to show alerts dynamically via JS.........................//
function showDynamicAlert(message, type = 'success') {
    const alertContainer = document.getElementById('alert-container');
    
    // Create the alert div using your existing classes
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
    alertDiv.textContent = message;

    // Append it to the container
    alertContainer.appendChild(alertDiv);

    // Auto-fade and remove after 4 seconds (matching your auto-hide script)
    setTimeout(() => {
        alertDiv.style.opacity = '0';
        setTimeout(() => alertDiv.remove(), 500);
    }, 4000);
}
//.....................................//

//................................Sortable Enable ........................................//
const sortable = new Sortable(tasksContainer, {
    group: "shared",
    animation: 150,
    onEnd: async (event) => {
        // If "0" (All Projects) is selected
        if (projectSelect.value === "0") {
            
            // Gather ordered IDs
            const orderedTasksIds = Array.from(tasksContainer.querySelectorAll('.tasks')).map(task => {
                return task.id.replace('task_', ''); 
            });

            try {
                // Send new order to backend
                const response = await fetch('/tasks/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': window.csrfToken
                    },
                    body: JSON.stringify({ tasks_ids: orderedTasksIds })
                });

                const data = await response.json();
                console.log('Priorities updated successfully:', data);

                // Trigger your nice-looking success alert dynamically!
                showDynamicAlert(data.message || 'Task priorities updated successfully!');

                // Update UI priority numbers live without refreshing
                const tasks = document.querySelectorAll(".tasks");
                tasks.forEach((task, index) => {
                    const taskNewPriority = index + 1;
                    
                    task.setAttribute('task_priority', taskNewPriority);

                    const supTag = task.querySelector('sup');
                    if (supTag) {
                        supTag.textContent = `(*${taskNewPriority})`;
                    }
                });

            } catch (error) {
                console.error('Error updating priorities:', error);
                // Trigger error alert dynamically if it fails
                showDynamicAlert('Failed to update task priorities.', 'error');
            }
        }
    }
});
//..............................................//
//*************************************//



// **************************************************************************************//
// WHAT HAPPEN WHEN YOU SELECT A PROJECT FROM DROP DOWN *********************************//
projectSelect.addEventListener("change", () => {
    const selectedValue = projectSelect.value; 
    
    // ............................... UPDATE H3 TAG TEXT INFO...................................//
    const h3TagTaskTnfo = document.getElementById('h3-tag-task-info');

    // Grab the text of the currently selected option
    const selectedOptionText = projectSelect.options[projectSelect.selectedIndex].text;

    // Update the h3 tag text info dynamically
    h3TagTaskTnfo.innerHTML = `Showing tasks for: ${selectedOptionText}`;
    // ........................................//


    // ................................SHOW / HIDE TASK LOGIC....................................//      
    const tasks = document.querySelectorAll(".tasks");

    tasks.forEach(task => {
        // Correctly read the custom attributes using getAttribute()
        const taskProjectId = task.getAttribute("task_project_id");

        // Filter checks:
        // 1. "0" (All Projects) is selected
        // 2. "-1" (Unassigned) is selected AND the task has no project ("null" or empty)
        // 3. A specific project ID matches
        const isAllProjects = selectedValue === "0";
        const isUnassigned = selectedValue === "-1" && (taskProjectId === "null" || taskProjectId === "" || !taskProjectId);
        const isProjectMatch = taskProjectId === selectedValue;

        if (isAllProjects || isUnassigned || isProjectMatch) {
            task.style.display = "block"; // Show the task

            // If this task matches a specific project, grab its computed background color
            if (isProjectMatch || isUnassigned) {
                const computedColor = window.getComputedStyle(task).backgroundColor;
                projectSelect.style.color = computedColor;
            }
        
        } else {
            task.style.display = "none";  // Hide the task
        }  
    });
    // ..........................................//


    // ..............................ENABLE / DISABLE SORTABLE OPTION............................// 
    if (selectedValue === "0") {
        projectSelect.style.color = ""; 
        
        // ENABLE drag-and-drop when viewing 0:all projects
        sortable.option("disabled", false);
        tasksContainer.style.cursor = "default"; // Optional: reset cursor style
    } else {
        // DISABLE drag-and-drop when a specific project or unassigned is filtered
        sortable.option("disabled", true);
    }
    // .............................................//

});
//*************************************//



// **************************************************************************************//
// CONTROL ALERT MESSAGES*********************************//
document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        // Option A: Click anywhere on the alert to dismiss it immediately
        alert.addEventListener('click', () => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // Removes from DOM after fade
        });

        // Option B: Auto-dismiss after 4 seconds (4000 milliseconds)
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        }, 2000);
    });
});
//*************************************//