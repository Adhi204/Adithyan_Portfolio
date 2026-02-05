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

        // PROJECTS
        const projectsEl = document.getElementById("projects-list");

        if (projectsEl && Array.isArray(data.projects)) {
            projectsEl.innerHTML = "";

            data.projects.forEach((project, index) => {
                const card = document.createElement("div");
                card.className =
                    "rounded-xl border bg-white p-6 shadow-sm hover:shadow transition";

                card.innerHTML = `
            <h3
                class="cursor-pointer text-xl font-semibold text-slate-900 hover:text-indigo-600 transition"
                data-project-index="${index}"
            >
                ${project.title}
            </h3>

            ${
                project.github_url
                    ? `<a href="${project.github_url}" target="_blank"
                          class="mt-3 inline-block text-sm font-medium text-slate-600 hover:text-indigo-600">
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

        document.addEventListener("click", (e) => {
            const target = e.target;

            if (target.matches("[data-project-index]")) {
                const project = data.projects[target.dataset.projectIndex];

                modalTitle.textContent = project.title;

                if (Array.isArray(project.description)) {
                    modalDescription.innerHTML = `
                <ul class="list-disc list-inside space-y-2">
                    ${project.description
                        .map((point) => `<li>${point}</li>`)
                        .join("")}
                </ul>
            `;
                } else {
                    modalDescription.textContent = project.description ?? "";
                }

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

        // RESUME
        const resumeBox = document.getElementById("resume-box");

        if (resumeBox && data.resume) {
            const resumeUrl = data.resume.file_name
                ? `/storage/documents/documents/${data.resume.file_name}`
                : null;

            const updatedDate = new Date(
                data.resume.updated_at,
            ).toLocaleDateString();

            resumeBox.innerHTML = `
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <p class="text-lg font-semibold text-slate-900">
                ${data.resume.title ?? "Resume"}
            </p>

            <p class="mt-1 text-sm text-slate-500">
                Last updated: ${updatedDate}
            </p>
        </div>

        ${
            resumeUrl
                ? `<a href="${resumeUrl}" target="_blank"
                     class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">
                     View PDF
                   </a>`
                : `<span class="text-sm text-slate-500">No resume available</span>`
        }

    </div>
    `;
        } else {
            resumeBox.innerHTML = `<p class="text-sm text-slate-500">No resume uploaded.</p>`;
        }

        // WHAT I DO / SERVICES
        const servicesEl = document.getElementById("services-list");

        if (servicesEl && Array.isArray(data.services)) {
            servicesEl.innerHTML = "";

            data.services.forEach((service) => {
                servicesEl.innerHTML += `
            <div class="rounded-2xl border border-slate-200 p-6
                        transition hover:shadow-md hover:-translate-y-1">
                <h3 class="text-lg font-semibold mb-2">
                    ${service.title}
                </h3>

                <p class="text-slate-600 text-sm leading-relaxed">
                    ${service.description}
                </p>
            </div>
        `;
            });
        }

        // CONTACT
        if (data.profile) {
            const { email, phone, github_link, linkedin_link } = data.profile;

            // Email
            if (email) {
                const el = document.getElementById("contact-email");
                el.href = `mailto:${email}`;
                document.getElementById("email-text").textContent = email;
                el.classList.remove("hidden");
            }

            // Phone
            if (phone) {
                const el = document.getElementById("contact-phone");
                el.href = `tel:${phone}`;
                document.getElementById("phone-text").textContent = phone;
                el.classList.remove("hidden");
            }

            // GitHub
            if (github_link) {
                const el = document.getElementById("contact-github");
                el.href = github_link;
                document.getElementById("github-text").textContent =
                    github_link.replace(/^https?:\/\//, "");
                el.classList.remove("hidden");
            }

            // LinkedIn
            if (linkedin_link) {
                const el = document.getElementById("contact-linkedin");
                el.href = linkedin_link;
                document.getElementById("linkedin-text").textContent =
                    linkedin_link.replace(/^https?:\/\//, "");
                el.classList.remove("hidden");
            }
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


//dashboard
document.querySelectorAll('.project-title').forEach(el => {
    el.addEventListener('click', () => {
        const form = document.getElementById('update-project-form');
        form.action = `/admin/${el.dataset.id}/updateProject`;

        document.getElementById('update-project-id').value = el.dataset.id;
        document.getElementById('update-title').value = el.dataset.title;
        document.getElementById('update-description').value = el.dataset.description;
        document.getElementById('update-github').value = el.dataset.github;
        document.getElementById('update-live').value = el.dataset.live;

        document.getElementById('update-project-modal').classList.remove('hidden');
    });
});

