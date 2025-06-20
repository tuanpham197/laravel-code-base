-- Bảng Family_Groups: Lưu thông tin về các gia đình
CREATE TABLE Family_Groups (
    family_group_id INT PRIMARY KEY AUTO_INCREMENT,
    family_name VARCHAR(100),
    created_date DATE DEFAULT CURRENT_DATE
);

-- Bảng Family_Members: Lưu thông tin thành viên gia đình
CREATE TABLE Family_Members (
    member_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    relationship VARCHAR(50),
    date_of_birth DATE,
    family_group_id INT NOT NULL,
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Bảng Accounts: Lưu thông tin tài khoản
CREATE TABLE Accounts (
    account_id INT PRIMARY KEY AUTO_INCREMENT,
    account_name VARCHAR(100) NOT NULL,
    account_type ENUM('checking', 'savings', 'credit card', 'investment', 'cash') NOT NULL,
    initial_balance DECIMAL(15, 2) DEFAULT 0.00,
    initial_balance_date DATE,
    member_id INT,
    family_group_id INT NOT NULL,
    FOREIGN KEY (member_id) REFERENCES Family_Members(member_id),
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Bảng Categories: Lưu danh mục giao dịch (chung cho tất cả gia đình)
CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(50) NOT NULL,
    category_type ENUM('expense', 'income', 'transfer') NOT NULL
);

-- Bảng Transactions: Lưu thông tin giao dịch
CREATE TABLE Transactions (
    transaction_id INT PRIMARY KEY AUTO_INCREMENT,
    transaction_date DATE NOT NULL,
    account_id INT NOT NULL,
    description TEXT,
    category_id INT NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    type ENUM('expense', 'income', 'transfer') NOT NULL,
    recurring_id INT,
    family_group_id INT NOT NULL,
    FOREIGN KEY (account_id) REFERENCES Accounts(account_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id),
    FOREIGN KEY (recurring_id) REFERENCES Recurring_Expenses(recurring_id),
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Bảng Budgets: Lưu ngân sách hàng tháng
CREATE TABLE Budgets (
    budget_id INT PRIMARY KEY AUTO_INCREMENT,
    month VARCHAR(7) NOT NULL, -- Định dạng 'YYYY-MM'
    category_id INT NOT NULL,
    budget_amount DECIMAL(15, 2) NOT NULL,
    family_group_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id),
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Bảng Assets: Lưu thông tin tài sản tiết kiệm
CREATE TABLE Assets (
    asset_id INT PRIMARY KEY AUTO_INCREMENT,
    asset_type ENUM('stock', 'mutual_fund', 'cryptocurrency', 'gold', 'silver', 'diamond') NOT NULL,
    description VARCHAR(200),
    quantity DECIMAL(15, 4) NOT NULL,
    unit VARCHAR(20),
    purchase_date DATE NOT NULL,
    purchase_price_per_unit DECIMAL(15, 2) NOT NULL,
    total_purchase_price DECIMAL(15, 2) NOT NULL,
    current_price_per_unit DECIMAL(15, 2),
    total_current_value DECIMAL(15, 2),
    member_id INT,
    family_group_id INT NOT NULL,
    FOREIGN KEY (member_id) REFERENCES Family_Members(member_id),
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Bảng Recurring_Expenses: Lưu thông tin chi tiêu định kỳ
CREATE TABLE Recurring_Expenses (
    recurring_id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(200),
    amount DECIMAL(15, 2) NOT NULL,
    frequency ENUM('daily', 'weekly', 'monthly', 'yearly') NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    category_id INT,
    account_id INT,
    family_group_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id),
    FOREIGN KEY (account_id) REFERENCES Accounts(account_id),
    FOREIGN KEY (family_group_id) REFERENCES Family_Groups(family_group_id)
);

-- Tạo chỉ mục để tối ưu truy vấn theo family_group_id
CREATE INDEX idx_family_members_family_group ON Family_Members(family_group_id);
CREATE INDEX idx_accounts_family_group ON Accounts(family_group_id);
CREATE INDEX idx_transactions_family_group ON Transactions(family_group_id);
CREATE INDEX idx_budgets_family_group ON Budgets(family_group_id);
CREATE INDEX idx_assets_family_group ON Assets(family_group_id);
CREATE INDEX idx_recurring_expenses_family_group ON Recurring_Expenses(family_group_id);