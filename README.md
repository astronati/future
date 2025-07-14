# Future

This project is based on [Symfony](https://symfony.com/) and uses the open-source, production-ready skeleton from [dunglas/symfony-docker](https://github.com/dunglas/symfony-docker). It provides a robust and modern Docker-based development environment.

---

## 📐 Architecture

The project follows **Domain-Driven Design (DDD)** principles and is organized into four main layers:

```
src/
 │
 ├── Application/
 │ └── UseCase/
 ├── Domain/
 ├── Infrastructure/
 └── Presentation/
```

### Application

The `Application` layer contains the **use cases** representing the business workflows of the application.

- The core directory here is `UseCase/`, where each use case is encapsulated in its own class.
- Each `UseCase` and its corresponding `Request` object is designed to be **independent of context**, meaning it can be triggered by:
    - An HTTP request (e.g. from a controller), or
    - An asynchronous message (e.g. from a queue consumer)

This promotes **separation of concerns** and **decoupling** between transport mechanisms and business logic.

### Domain

The `Domain` layer contains:

- The **core business entities**
- **Repository interfaces**, which abstract the data layer

These components are purely business-oriented and unaware of any infrastructure or delivery mechanisms.

### Infrastructure

The `Infrastructure` layer provides **concrete implementations** for interfaces defined in the `Domain` layer.

For example:

- The `ClassifierInterface` is implemented here using **OpenAI**.
- This implementation is **executed asynchronously** through a **message queue**.

Using a **queue** rather than direct synchronous calls has several advantages:

- **Improved resilience**: avoids failures due to network issues or rate limits from external APIs.
- **Better performance**: avoids blocking user-facing requests while waiting for third-party responses.
- **Retry mechanisms**: queues can retry failed tasks without user interaction.
- **Loose coupling**: the business logic doesn't depend directly on external service availability.

### Presentation

The `Presentation` layer acts as the entry point of the application, exposing the use cases via:

- HTTP controllers
- CLI commands
- Asynchronous message consumers

It translates user input into appropriate requests and forwards them to the application layer.

