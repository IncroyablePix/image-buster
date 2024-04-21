CREATE TABLE IF NOT EXISTS user_data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_agent TEXT NOT NULL,
    forwarded TEXT NOT NULL,
    ip_address TEXT NOT NULL,
    date DATE NOT NULL,
    referrer TEXT DEFAULT NULL,
    language TEXT DEFAULT NULL,
    device_type TEXT DEFAULT NULL,
    browser_version TEXT DEFAULT NULL,
    operating_system TEXT DEFAULT NULL
);