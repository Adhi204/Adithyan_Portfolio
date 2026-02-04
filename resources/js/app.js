import "./bootstrap";

document.addEventListener("DOMContentLoaded", async () => {
    try {
        const res = await fetch("/api/portfolio");
        const data = await res.json();

        //PROFILE
        if (data.profile) {
            document.getElementById("name").textContent =
                data.profile.name ?? "";

            document.getElementById("designation").textContent =
                data.profile.designation ?? "";

            document.getElementById("about").textContent =
                data.profile.about ?? "";

            if (data.profile.avatar) {
                document.getElementById("avatar").src = data.profile.avatar;
            }
        }

        //PROJECTS
        const projectsEl = document.getElementById("projects-list");

        if (projectsEl && Array.isArray(data.projects)) {
            projectsEl.innerHTML = "";

            data.projects.forEach((project) => {
                const card = document.createElement("div");
                card.className =
                    "rounded-xl border bg-white p-6 shadow-sm hover:shadow transition";

                card.innerHTML = `
            <h3
                class="cursor-pointer text-xl font-semibold text-indigo-600 hover:underline"
                data-title="${project.title}"
                data-description="${project.description.replace(/"/g, "&quot;")}"
            >
                ${project.title}
            </h3>

            ${
                project.github_url
                    ? `<a href="${project.github_url}" target="_blank"
                          class="mt-3 inline-block text-sm font-medium text-slate-700 hover:text-indigo-600">
                          View on GitHub →
                       </a>`
                    : ""
            }
        `;

                projectsEl.appendChild(card);
            });
        }

        //project model
        const modal = document.getElementById("project-modal");
        const modalTitle = document.getElementById("modal-title");
        const modalDescription = document.getElementById("modal-description");
        const modalClose = document.getElementById("modal-close");

        // Open modal
        document.addEventListener("click", (e) => {
            const target = e.target;

            if (target.matches("[data-title]")) {
                modalTitle.textContent = target.dataset.title;
                modalDescription.textContent = target.dataset.description;

                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
        });

        // Close modal
        modalClose.addEventListener("click", () => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        });

        // Close on backdrop click
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }
        });

        //SKILLS
        const skillsEl = document.getElementById("skills-list");
        if (skillsEl && Array.isArray(data.skills)) {
            skillsEl.innerHTML = "";
            data.skills.forEach((skill) => {
                skillsEl.innerHTML += `
                    <span class="rounded-lg bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                        ${skill.name}
                    </span>
                `;
            });
        }

        //RESUME
        const resumeEl = document.getElementById("resume-box");
        if (resumeEl && data.resume) {
            resumeEl.innerHTML = `
                <div class="rounded-xl border p-6 flex justify-between items-center">
                    <p class="font-semibold">${data.resume.title ?? "My Resume"}</p>
                </div>
            `;
        }

        //SCROLL ANIMATION
        document.querySelectorAll("section").forEach((section) => {
            section.classList.add("opacity-0", "translate-y-6");

            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        section.classList.remove("opacity-0", "translate-y-6");
                        section.classList.add("transition-all", "duration-700");
                    }
                },
                {
                    threshold: 0.15,
                },
            );

            observer.observe(section);
        });
    } catch (err) {
        console.error("❌ Portfolio load failed", err);
    }

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    });
});
