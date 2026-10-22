
document.addEventListener('DOMContentLoaded', () => {
    const tasksContainer = document.getElementById('tasks_container');
    const projectSelect = document.querySelector(".projects");

    // If tasksContainer isn't on this page (e.g. we are on the create/edit form), exit gracefully
    if (!tasksContainer || !projectSelect) return;

    // **************************************************************************************//
    // SORTABLE ENABLE AND DRAG & DROP CODE ************************************************//

    // ............Helper function to show alerts dynamically via JS.........................//
    function showDynamicAlert(message, type = 'success') {
        const alertContainer = document.getElementById('alert-container');
        if (!alertContainer) return;
        
        // Create the alert div using your existing classes
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
        alertDiv.textContent = message;

        // Append it to the container
        alertContainer.appendChild(alertDiv);

        // Auto-fade and remove after 4 seconds
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
            // Prevent triggering reorder if the item was clicked/tapped without actually changing position
            if (event.oldIndex === event.newIndex) {
                console.log('Task position unchanged; reorder skipped.');
                return;
            }

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

                    // Trigger success alert dynamically
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


    // **************************************************************************************//
    // WHAT HAPPENS WHEN YOU SELECT A PROJECT FROM DROP DOWN *********************************//
    projectSelect.addEventListener("change", () => {
        const selectedValue = projectSelect.value; 
        
        const h3TagTaskTnfo = document.getElementById('h3-tag-task-info');
        if (h3TagTaskTnfo) {
            const selectedOptionText = projectSelect.options[projectSelect.selectedIndex].text;
            h3TagTaskTnfo.innerHTML = `Showing tasks for: ${selectedOptionText}`;
        }

        const tasks = document.querySelectorAll(".tasks");

        tasks.forEach(task => {
            const taskProjectId = task.getAttribute("task_project_id");

            const isAllProjects = selectedValue === "0";
            const isUnassigned = selectedValue === "-1" && (taskProjectId === "null" || taskProjectId === "" || !taskProjectId);
            const isProjectMatch = taskProjectId === selectedValue;

            if (isAllProjects || isUnassigned || isProjectMatch) {
                task.style.display = "flex"; // Keep it flex to match your row layout

                if (isProjectMatch || isUnassigned) {
                    const computedColor = window.getComputedStyle(task).backgroundColor;
                    projectSelect.style.color = computedColor;
                    // console.log(computedColor);
                }
            } else {
                task.style.display = "none";  // Hide the task
            } 
        });

        if (selectedValue === "0") {
            projectSelect.style.color = ""; 
            sortable.option("disabled", false);
            tasksContainer.style.cursor = "default";
        } else {
            sortable.option("disabled", true);
        }
    });
});

// **************************************************************************************//
// CONTROL ALERT MESSAGES (Global for all pages) ****************************************//
document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        alert.addEventListener('click', () => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });

        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        }, 2000);
    });
});