# MUL – Regional Ride-Hailing System (2018)

MUL is a regional ride-booking platform built in **2018** using the CodeIgniter framework with an **HMVC architecture**.  
It enabled customers in **Swat, Pakistan** to book local and inter-city rides, while allowing drivers (captains) and fleet partners (vendors) to operate within a structured mobility system.

This project represents a complete early-stage mobility ecosystem deployed before ride-hailing services existed in the region, demonstrating real-world engineering execution in an emerging technology market.

---

## Overview

- Built and deployed in 2018
- ~200 customer signups during pilot
- Driver adoption was early-stage due to market maturity
- Driver and Customer Android apps integrated (built by collaborator, technical leadership by me)
- Backend, admin panel, database and operational logic engineered by me
- Platform retired due to funding constraints, not technical issues
- Public repo contains safe structural and functional documentation
- Private evidence available upon request (emails, DB timestamp screenshots, deployment proofs)

---

## System Goals

- Digitize local and inter-city transportation in a region without ride-hailing services
- Introduce structured booking, pricing and verification processes
- Support **individual drivers and fleet operators**
- Enable digital payments and driver wallet accounting
- Lay foundation for scalable mobility system with modular HMVC design

---

## Platform Model – Roles

### Customer
End-user booking rides, managing trips and viewing history.

### Captain (Driver)
Service provider operating a vehicle, accepting rides, and earning through wallet settlement.

### Vendor (Fleet Partner)
A **fleet owner or transport business** operating multiple drivers and vehicles under one account.

This is significant because, in 2018, most ride-hailing systems focused only on individual drivers.  
MUL supported both **B2C drivers** and **B2B fleet operators**, which was rare in the region at that time.  
This introduced a scalable and structured ecosystem similar to fleet networks used by professional transport companies.
<img width="1910" height="693" alt="image" src="https://github.com/user-attachments/assets/599f91a0-99d3-4441-8d58-4ce90d923c8e" />
### Admin
Manages system configuration, pricing, verifications, and operations.

---

## Key Functional Capabilities

### Customer Experience
- Local and inter-city ride booking
- Live location selection
- Ride history panel

### Driver Operations
- Profile and document submission
- Ride acceptance and completion workflow
- Wallet balance and earnings tracking

### Vendor (Fleet Partner) System
- Register transport business
- Add and manage multiple drivers and vehicles
- Track performance and earnings
- Participate in revenue share structure

### Admin Control
- Booking oversight and manual dispatch
- Fare and category configuration
- Captain and vendor verification
- Complaint handling and audit traces
- Reporting and operational monitoring

---

## Architecture

### Framework
- CodeIgniter with **HMVC** modular structure

### Module Responsibilities
- Authentication and Authorization
- Ride lifecycle management
- Vendor and Captain management
- Vehicle onboarding and inspection
- Pricing and fare rules
- Wallet and settlement ledger
- Complaint processing
- Admin functions and audit logs

HMVC ensured each domain (ride, vendor, captain, wallet, complaints) had isolated logic, enabling scalability and maintainability.

---

## Database Design

Relational MySQL schema with normalized tables and referential mapping.

Core tables included:

- Users (customers)
- Captains (drivers)
- Vendors (fleet operators)
- Vehicles
- Vehicle inspections
- Rides and ride status history
- Wallet ledger (transactional accounting)
- Pricing categories
- Complaints and resolution logs
- Admin users & permissions

Design principles:

- Status-driven ride flow tracking
- Transaction-based wallet entries
- Audit logging to trace operational actions
- Structured vendor-driver-customer hierarchy

---

## Engineering Considerations

- Market had no ride-hailing infrastructure — required lightweight, robust stack
- Modular HMVC ensured future modules could be added without refactor
- Pricing logic integrated with Maps distance calculations
- Operational workflows designed for region with limited digital adoption
- Session validation and role access implemented for security
- Optimized for shared hosting environment common in 2018 Pakistan

---

## Deployment Context & Market Relevance

- First digital mobility pilot of its kind in Swat region
- System designed to operate in a low-tech adoption phase
- Vendor concept allowed onboarding of **transport businesses**, not only individuals
- Demonstrated technical ability to introduce structured mobility systems in non-urban emerging market

---

## Evidence & Confidentiality

Public repository includes:

- Architecture explanation
- Module structure descriptions
- Screenshots of admin and booking UI

Private proof available on request:

- Deployment timestamp emails (2018)
- DB snapshot showing early user signups (anonymized)
- Archived operational screenshots

Personal data is **not** made public.

---

## Screenshots

Screenshots stored in `/screenshots/` including:

- Dashboard panel
- <img width="1886" height="904" alt="image" src="https://github.com/user-attachments/assets/d84071b3-835d-4198-ab8c-213e62bd9a4f" />

- Ride booking interface
- <img width="1889" height="868" alt="image" src="https://github.com/user-attachments/assets/0b079455-3398-49ce-912b-3fd8fcd43491" />

- Offices Interface Vendor interfaces
- <img width="1889" height="917" alt="image" src="https://github.com/user-attachments/assets/06d53d35-9a3e-4d65-a538-9b4ab839b6a1" />

- Payment Screen
<img width="1877" height="845" alt="image" src="https://github.com/user-attachments/assets/06189f3a-4275-4870-823e-9446d5b95792" />

---

## Status

- Built and deployed in 2018
- Real user onboarding and pilot rides
- System archived after funding constraints
- Architecture and design remain valid and scalable

---

## Author

**Waheed Shah**  
Backend Engineer & System Architect  
Email: waheedshah340@gmail.com  
GitHub: github.com/waheedshahdev  
LinkedIn: linkedin.com/in/waheed-shah-68267010b
