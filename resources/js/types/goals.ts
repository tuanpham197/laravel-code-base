export interface Wallet {
    id: string;
    name: string;
    balance: number;
    maxBalance: number;
    progress: number;
}

export interface FinancialSummary {
    lastMonth: number;
    expenses: number;
    taxes: number;
    debt: number;
}

export interface Goal {
    id: string;
    name: string;
    currentAmount: number;
    targetAmount: number;
    progress: number;
    financialSummary: FinancialSummary;
    wallets: Wallet[];
}

export interface Transaction {
    id: string;
    date: string;
    wallet: string;
    description: string;
    amount: number;
}

export interface FinancialSummary {
    lastMonth: number;
    expenses: number;
    taxes: number;
    debt: number;
}
